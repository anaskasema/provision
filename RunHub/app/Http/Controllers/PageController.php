<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    // ... داخل الكلاس ...

    // استقبال الرسالة من صفحة اتصل بنا
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Message::create($request->all());

        return back()->with('success', 'تم استلام رسالتك بنجاح! سيتواصل معك فريقنا قريباً.');
    }
    public function privacy()
    {
        return view('pages.privacy');
    }
}
