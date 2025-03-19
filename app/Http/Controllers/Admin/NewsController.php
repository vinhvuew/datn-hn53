<?php

namespace App\Http\Controllers\Admin;
use Intervention\Image\Facades\Image;
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

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Lấy kích thước gốc của ảnh
            list($width, $height) = getimagesize($image);

            // Resize ảnh
            $newWidth = 800;
            $newHeight = (int)(($newWidth / $width) * $height);
            $img = imagecreatetruecolor($newWidth, $newHeight);

            // Lấy ảnh gốc và resize
            $imageResource = imagecreatefromstring(file_get_contents($image));
            imagecopyresampled($img, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Lưu ảnh và giải phóng bộ nhớ
            $imagePath = 'news/' . $imageName;
            imagejpeg($img, storage_path('app/public/news/' . $imageName), 90);
            imagedestroy($img);
            imagedestroy($imageResource);
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


    public function update(Request $request, string $id)
    {
        $news = CreateNews::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Giữ nguyên ảnh cũ nếu không có ảnh mới
        $imagePath = $news->image;
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($news->image && file_exists(storage_path('app/public/' . $news->image))) {
                unlink(storage_path('app/public/' . $news->image));
            }

            // Xử lý ảnh mới
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            list($width, $height) = getimagesize($image);

            // Resize ảnh
            $newWidth = 800;
            $newHeight = (int)(($newWidth / $width) * $height);
            $img = imagecreatetruecolor($newWidth, $newHeight);
            $imageResource = imagecreatefromstring(file_get_contents($image));
            imagecopyresampled($img, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Lưu ảnh
            $imagePath = 'news/' . $imageName;
            imagejpeg($img, storage_path('app/public/news/' . $imageName), 90);
            imagedestroy($img);
            imagedestroy($imageResource);
        }

        // Cập nhật tin tức
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'Tin tức đã được cập nhật.');
    }



    public function destroy($id)
    {
        $news = CreateNews::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'Tin tức không tồn tại.');
        }

        // Xóa ảnh và tin tức
        if ($news->image && file_exists(storage_path('app/public/' . $news->image))) {
            unlink(storage_path('app/public/' . $news->image));
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Tin tức đã được xóa.');
    }


}
