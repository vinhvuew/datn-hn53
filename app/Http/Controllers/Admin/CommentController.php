<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listComment = Comment ::all();
        return view('admin.comment.index', compact('listComment'));

    }

    /**
     * Show the form for creating a new resource.
     */
    

    public function create()
    {
       return view('admin.comment.vipham');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $commen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $commen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $commen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */  
 
    public function destroy($id)
{
    try {
     
        $comment = Comment::findOrFail($id); 
        $comment->delete(); 

        return redirect()->route('comment.index')->with('success', 'Xóa Bình Luận Vi Phạm Cộng Đồng Thành Công!');
    } catch (\Exception $e) {
        
        return redirect()->route('comment.index')->with('error', 'Xóa Bình Luận Vi Phạm Cộng Đồng Thất Bại!');
    }
}

}
