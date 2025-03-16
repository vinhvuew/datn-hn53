<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreateNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listNews = CreateNews::all();
        return view('admin.news.index', compact('listNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            // Validate dữ liệu đầu vào
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Xử lý upload hình ảnh
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('news', 'public');
            }

            // Tạo tin tức mới
            CreateNews::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath,
            ]);

            return redirect()->route('news.index')->with('success', 'Tin tức đã được thêm thành công.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = CreateNews::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = CreateNews::findOrFail($id);
        // return view('news.edit', compact('news'));
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = CreateNews::findOrFail($id);
        $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    $news->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('news.index',$id)->with('success', 'Tin tức đã cập nhật lại.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news =  CreateNews::find($id);
        if (!$news) {
            return redirect()->route('news.index')->with('error', 'Tin tức không tồn tại.');
        }



        $news->delete();
        return redirect()->route('news.index')->with('success', 'Tin tức đã được xóa.');
    }

}
