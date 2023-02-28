<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class StockController extends Controller
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
        $title = "Stocks";
        $data = Stock::whereDate('expiry_date', ">=", Carbon::today())->get();
        return view('stocks.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $new_stock = new Stock();
        $new_stock->id = floor(time()-999999999);
        $new_stock->item = ucfirst($request["item"]);
        $new_stock->description = ucfirst($request["description"]);
        $new_stock->in_stock = $request["qty"];
        $new_stock->unit = $request["unit"];
        $new_stock->expiry_date = $request["expiry_date"];
        $new_stock->category_id = $request["category_id"];
        $new_stock->save();

        //success, error, info, warning
        Toastr::success('New stock added successfully :)','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Details";
        $data = Stock::find($id);
        return view('stocks.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockRequest  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        $update_stock = Stock::find($id);
        $update_stock->item = ucfirst($request["item"]);
        $update_stock->description = $request["description"];
        $update_stock->in_stock = $request["in_stock"];
        $update_stock->unit = $request["unit"];
        $update_stock->expiry_date = $request["expiry_date"];
        $update_stock->save();

        //success, error, info, warning
        Toastr::success('Stock updated successfully :)','Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $del_caterogy = Stock::find($request['stock_id']);
        $del_caterogy->delete();

        //success, error, info, warning
        Toastr::success('Category deleted successfully :)','Success');
        return back();
    }
}