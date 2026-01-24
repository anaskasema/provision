<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // تبديل الحالة (Like / Unlike)
    public function toggle(Item $item)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // إذا كانت موجودة نحذفها، وإذا لم تكن موجودة نضيفها
        $user->favorites()->toggle($item->id);

        return back();
    }

    // عرض صفحة المفضلة
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // التصحيح هنا: حذفنا القوسين من $user
        $favorites = $user->favorites()->with('category')->latest()->get();

        return view('favorites.index', compact('favorites'));
    }
}
