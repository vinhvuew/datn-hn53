<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const OBJECT = 'categorys';
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $categories = Category::all();
        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:50|unique:categories,name",
        ], [
            'name.required' => 'Bạn không được để trống tên danh mục',
            'name.max' => 'Bạn không được điền quá :max kí tự',
            'name.unique' => 'Tên danh mục đã tồn tại, vui lòng chọn tên khác'
        ]);

        $params = $request->all();
        $obj = Category::create($params);
        if ($obj) {
            return redirect()->route('category.index')->with('categorySuccess', 'Thêm danh mục thành công');
        }
    }

    public function edit($id)
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            "name" => "required|max:50",
        ], [
            'name.required' => 'Bạn không được để trống tên danh mục',
            'name.max' => 'Bạn khôg được điền quá :max kí tự'
        ]);
        $params = $request->all();
        $obj = Category::findOrFail($id);
        $obj->update($params);
        if ($obj) {
            return redirect()->route('category.index')->with('categorySuccess', 'Sửa danh mục thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->authorize('modules', self::OBJECT . '.' . __FUNCTION__);
        } catch (\Throwable $th) {
            return response()->view('admin.errors.unauthorized', ['message' => 'Bạn không có quyền truy cập!']);
        }
        $category = Category::findOrFail($id);
        if ($category) {
            $category->delete();
            return redirect()->route('category.index')->with('categorySuccess', 'Xoá thành công danh mục');
        }
    }
}
