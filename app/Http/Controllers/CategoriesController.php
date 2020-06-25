<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::orderBy('id','DESC')->get();
//        number auto increase

        $id = Categories::latest()->first();
        if (isset($id)){
            $code = $id->id + 1;
        return view('categories.index',compact('category', 'code'));
        }
        return view('categories.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'code' => 'required|unique:categories,code',
            'name' => 'required|unique:categories,name',
        ]);
        $category = Categories::create([
            'code' => str_pad($request->input('code') + 0, 3, 0, STR_PAD_LEFT),
            'name' => $request->input('name')]);
        return redirect()->route('categories.index')
            ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate_id = Categories::findOrFail($id);
        $category = Categories::orderBy('id','DESC')->get();
        return view('categories.edit', compact('cate_id', 'category'));
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
        $update_category = Categories::find($id);
        $update_category->code = $request->input('code');
        $update_category->name = $request->input('name');
        $update_category->save();

        return redirect()->route('categories.index')
            ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::where('id',$id)->delete();
        return redirect()->route('categories.index')
            ->with('success','Category deleted successfully');
    }
}
