<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth', ['except' => ['welcome']]);
        $this->middleware('auth.lock');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Categories";
        $data = Category::all();
        return view('categories.index', compact('title', 'data'));
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $new_category = new Category();
        $new_category->name = $request["name"];
        $new_category->save();

        //success, error, info, warning
        Toastr::success('New category added successfully :)','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        $update_caterogy = Category::find($request['cat_id']);
        $update_caterogy->name = $request['update_name'];
        $update_caterogy->save();

        //success, error, info, warning
        Toastr::success('New category added successfully :)','Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if(!Stock::where('category_id', $request['cat_id'])->exists()){
            $del_caterogy = Category::find($request['cat_id']);
            $del_caterogy->delete();

            //success, error, info, warning
            Toastr::success('Category deleted successfully :)','Success');
            return back();
        }else{
           //success, error, info, warning
            Toastr::warning('Category cannot be deleted :)','Warning');
            Toastr::info('Active Stock is under this Category :)','Info');
            return back(); 
        }
    }
}