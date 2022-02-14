<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Validator;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sub_categorys = Category::whereNotNull('parent_id')->get();
      return view('sub_category.index',compact('sub_categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $category = null;
      $parents = Category::whereNull('parent_id')->get();
      return view('sub_category.form',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                  'title' => 'required|string',
                  'parent_id' => 'required|exists:categories,id',
                  'image' => ''
          ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->image)
        {
          $imgExtensions = array("png","jpeg","jpg");
          $file = $request->image;
          if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
          {
              \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
              return back();
         }
       }

      $category = Category::create($request->all());

      \Session::flash('success', 'Sub Category Created Successfully');
      return redirect('sub_category/'.$request->parent_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::findOrFail($id);
      $sub_categorys = $category->sub_cats;
      return view('category.show_sub_category',compact('sub_categorys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category = Category::findOrFail($id);
      $parents = Category::whereNull('parent_id')->get();
      return view('sub_category.form',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
                  'title' => 'required|string',
                  'parent_id' => 'required|exists:categories,id',
                  'image' => ''
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }
      $category = Category::findOrFail($id);

      if($request->image){
        $imgExtensions = array("png","jpeg","jpg");
        $file = $request->image;
        if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
        {
            \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
            return back();
       }
        $this->delete_image_if_exists(base_path('/uploads/category/'.basename($category->image)));
      }

      $category->update($request->all());

      \Session::flash('success', 'Sub Category Updated Successfully');
      return redirect('sub_category/'.$request->parent_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::findOrFail($id);

      if($category->image){
        $this->delete_image_if_exists(base_path('/uploads/category/'.basename($category->image)));
      }
      $category->delete();

      \Session::flash('success', 'Sub Category Delete Successfully');
      return back();
    }
}
