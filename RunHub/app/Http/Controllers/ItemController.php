<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * عرض قائمة المعدات مع الفلترة والترتيب
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // 1. بحث بالاسم أو الوصف
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        // 2. فلتر الفئة
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 3. فلتر المدينة
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // 4. الترتيب
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price_per_day', 'desc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        // تنفيذ الاستعلام
        $items = $query->paginate(9)->withQueryString();
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    /**
     * عرض تفاصيل معدة واحدة
     */
    public function show(Item $item)
    {
        // جلب معدات مشابهة من نفس الفئة
        $relatedItems = Item::where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->take(4)
            ->get();

        return view('items.show', compact('item', 'relatedItems'));
    }

    /**
     * عرض نموذج إضافة معدة جديدة
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * حفظ معدة جديدة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'city' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. معالجة الصور
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('items', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
        }

        // 2. معالجة المواصفات (specifications)
        $specs = [];
        if ($request->has('spec_keys') && $request->has('spec_values')) {
            foreach ($request->spec_keys as $index => $key) {
                if (!empty($key) && !empty($request->spec_values[$index])) {
                    $specs[$key] = $request->spec_values[$index];
                }
            }
        }

        // 3. إنشاء المعدة
        Item::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'currency' => 'YER',
            'city' => $request->city,
            'is_available' => true,
            'images' => $imagePaths, // يتم تحويلها لـ JSON تلقائياً في المودل (Casts)
            'specifications' => $specs, // اسم العمود كما طلبت
        ]);

        return redirect()->route('provider.dashboard')->with('success', 'تم إضافة المعدة بنجاح!');
    }

    /**
     * عرض نموذج تعديل المعدة (EDIT)
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);

        // الحماية: التأكد أن المستخدم هو صاحب المعدة
        if ($item->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذه المعدة');
        }

        $categories = Category::all();

        // نمرر المتغيرات للفيو
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * تحديث بيانات المعدة (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        // الحماية
        if ($item->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذه المعدة');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required|string',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // تحديث البيانات الأساسية
        $item->title = $request->title;
        // تحديث الـ slug عند تغيير الاسم (اختياري)
        // $item->slug = Str::slug($request->title) . '-' . $item->id;
        $item->category_id = $request->category_id;
        $item->city = $request->city;
        $item->description = $request->description;
        $item->price_per_day = $request->price_per_day;

        // تحديث المواصفات (specifications)
        if ($request->has('spec_keys') && $request->has('spec_values')) {
            $specs = [];
            foreach ($request->spec_keys as $index => $key) {
                if (!empty($key) && !empty($request->spec_values[$index])) {
                    $specs[$key] = $request->spec_values[$index];
                }
            }
            $item->specifications = $specs;
        }

        // معالجة الصور (إضافة صور جديدة للموجودة)
        if ($request->hasFile('images')) {
            // جلب الصور القديمة (نتعامل معها كمصفوفة)
            $existingImages = $item->images ?? [];

            $newImages = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('items', 'public');
                $newImages[] = '/storage/' . $path;
            }

            // دمج المصفوفتين
            $item->images = array_merge($existingImages, $newImages);
        }

        $item->save();

        return redirect()->route('provider.dashboard')->with('success', 'تم تحديث بيانات المعدة بنجاح.');
    }

    /**
     * حذف معدة من قاعدة البيانات
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // الحماية
        if ($item->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بحذف هذه المعدة.');
        }

        // حذف المعدة
        $item->delete();

        return back()->with('success', 'تم حذف المعدة بنجاح.');
    }
}
