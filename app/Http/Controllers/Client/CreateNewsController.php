<?php

namespace App\Http\Controllers\Client;

use App\Models\createnews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function news()
    {
        $news = CreateNews::all(); // Lấy danh sách tin tức
        return view('client.news.index', compact('news'));
    }

    public function show($id)
    {
        $news = CreateNews::findOrFail($id); // Lấy bài viết theo ID
        return view('client.news.show', compact('news'));
    }

}
