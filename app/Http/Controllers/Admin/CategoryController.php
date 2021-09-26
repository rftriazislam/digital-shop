<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{

    public function category()
    {
        $category_info = Category::OrderBy('id', 'desc')->paginate(10);
        return view('admin.pages.category', compact('category_info'));
    }

    public function categorysave(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $category_add = new Category();
        $category_add->name = $request->name;
        $category_add->form_name = $request->form_name;
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1900, 1140)->save(public_path('back_end/category_images/' . $filename));
            $category_add->image = $filename;
        }
        $category_add->save();
        return back()->with('message', 'Add Category');
    }

    public function categorystatus($status, $id)
    {
        $category_info = Category::find($id);
        if ($status == '0') {
            $category_info->status = '1';
        } else {
            $category_info->status = '0';
        }
        $category_info->save();
        return back()->with('message', 'Publication status Update');
    }

    public function categorydelete($id)
    {
        Category::find($id)->delete();
        return back()->with('dmessage', ' Delete Category Successfully');
    }
    public function categoryedit($id)
    {
        $category_info = Category::OrderBy('id', 'desc')->paginate(10);
        $category_edit = Category::find($id);
        return view('admin.pages.categoryedit', compact('category_info', 'category_edit'));
    }

    public function categoryupdated(Request $request)
    {

        $category_update = Category::find($request->category_id);
        $category_update->name = $request->name;
        $category_update->form_name = $request->form_name;
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = $request->category_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(650, 450)->save(public_path('back_end/category_images/' . $filename));
            $category_update->image = $filename;
        }

        $category_update->save();

        return redirect()->route('admin.category')->with('message', 'category updated');
    }
    //-----------------------------------------------------------------------category---------------------------------------------------




}