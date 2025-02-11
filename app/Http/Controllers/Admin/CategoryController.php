<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Category::all();
        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|max:50",
        ],[
            'name.required'=>'Bạn không được để trống tên danh mục',
            'name.max'=>'Bạn khôg được điền quá :max kí tự'
        ]);
        $params = $request->all();
        $obj = Category::create($params);
        if($obj){
            return redirect()->route('category.index')->with('categorySuccess','Thêm danh mục thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            "name"=> "required|max:50",
        ],[
            'name.required'=>'Bạn không được để trống tên danh mục',
            'name.max'=>'Bạn khôg được điền quá :max kí tự'
        ]);
        $params = $request->all();
        $obj = Category::findOrFail($id);
        $obj->update($params);
        if($obj){
            return redirect()->route('category.index')->with('categorySuccess','Sửa danh mục thành công');
        }    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $category = Category::findOrFail($id);
        if($category){
      $category->delete();
      return redirect()->route('category.index')->with('categorySuccess','Xoá thành công danh mục');
        }
    }
}
