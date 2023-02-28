<?php

namespace App\Http\Controllers;

use App\Charts\TransactionChart as ChartsTransactionChart;
use App\Models\Category;
use App\Models\Patient;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Charts\TransactionChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth', ['except' => ['welcome']]);
        $this->middleware('auth.lock');
    }

    public function welcome()
    {
        if(!auth()->guest())
        {
            return redirect()->route('home');
        }
        else
        {
            return view('welcome');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(TransactionChart $transac)
    {
        if(!auth()->guest())
        {
            $title = "Dashboard";
            $patients = Patient::count();
            $categories = Category::count();
            $stocks = Stock::whereDate('expiry_date', ">=", Carbon::today())->count();
            $transactions = Transaction::count();

            $new_data = Stock::whereDate('created_at', "=", Carbon::today())->get();
            $expired_data = Stock::whereDate('expiry_date', "<", Carbon::today())->get();
            return view('home', [
                'title' => $title, 
                'new_data' => $new_data, 
                'expired_data' => $expired_data, 
                'patients' => $patients, 
                'categories' => $categories, 
                'stocks' => $stocks, 
                'transactions' => $transactions,
                'transac' => $transac->build()
            ]);
        }
        else
        {
            return redirect()->guest('login');
        }
    }
}