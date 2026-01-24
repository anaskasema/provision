<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // جلب الفئات الـ 6 الأولى
        $categories = Category::take(6)->get();

        // جلب أحدث 8 معدات مع بيانات المزود والفئة (لتقليل الاستعلامات)
        $latestItems = Item::with(['user', 'category'])
            ->where('is_available', true)
            ->latest()
            ->take(8)
            ->get();

        return view('welcome', compact('categories', 'latestItems'));
    }
}
