<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        if(Stock::whereDate('expiry_date', ">=", Carbon::today())->orderBy('created_at')->count() > 0){
            $data = [
                'title' => 'RHU Villaviciosa',
                'data' => Stock::whereDate('expiry_date', ">=", Carbon::today())->orderBy('created_at')->get(),
                'user' => User::find(auth()->user()->id),
            ];
            $pdf = PDF::loadView('myPDF',  $data)->setPaper('a4', 'landscape');
            
            //stream to view the pdf (title of the PDF to be download)
            //download to download the file (title of the PDF to be download)
            return $pdf->stream('List.pdf');

            }else{
                return redirect()->route('stocks.index');
            }
    }
}