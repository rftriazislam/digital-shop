<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subcategory;
use Illuminate\Http\Request;
use Image;

class SubcategoryController extends Controller
{
    //-----------------------------------------------------------------------subcategory---------------------------------------------------
    public function subcategory()
    {
        $category_info = Category::where('status', 1)->get();

        $subcategory_info = Subcategory::OrderBy('id', 'desc')->paginate(10);
        return view('admin.pages.subcategory', compact('subcategory_info', 'category_info'));
    }
    public function subcategorysave(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subcategories,name',
            'image' => 'required',

        ]);
        $subcategory_add = new Subcategory();
        $subcategory_add->category_id = $request->category_id;
        $subcategory_add->name = $request->name;
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(650, 450)->save(public_path('back_end/subcategory_images/' . $filename));
            $subcategory_add->image = $filename;
        }
        $subcategory_add->save();

        return back()->with('message', 'Add sub Category');
    }

    public function subcategorystatus($status, $id)
    {
        $subcategory_info = Subcategory::find($id);
        if ($status == '0') {
            $subcategory_info->status = '1';
        } else {
            $subcategory_info->status = '0';
        }
        $subcategory_info->save();
        return back()->with('message', 'Publication status Update');
    }

    public function subcategorydelete($id)
    {
        Subcategory::find($id)->delete();
        return back()->with('dmessage', ' Delete Category Successfully');
    }
    public function subcategoryedit($id)
    {
        $category_info = Category::where('status', 1)->get();
        $subcategory_info = Subcategory::OrderBy('id', 'desc')->paginate(10);
        $subcategory_edit = Subcategory::find($id);
        return view('admin.pages.subcategoryedit', compact('category_info', 'subcategory_info', 'subcategory_edit'));
    }
    public function subcategoryupdated(Request $request)
    {

        $subcategory_update = Subcategory::find($request->subcategory_id);
        $subcategory_update->category_id = $request->category_id;
        $subcategory_update->name = $request->name;

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(650, 450)->save(public_path('back_end/subcategory_images/' . $filename));
            $subcategory_update->image = $filename;
        }
        $subcategory_update->save();
        return redirect()->route('admin.subcategory')->with('message', 'category updated');
    }

    //-----------------------------------------------------------------------subcategory---------------------------------------------------
}