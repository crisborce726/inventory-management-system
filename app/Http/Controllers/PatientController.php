<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class PatientController extends Controller
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
        $title = "Patients";
        $data = Patient::all();
        return view('patients.index', compact('title', 'data'));
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
     * @param  \App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $new_patient = new Patient();
        $new_patient->firstname = strtoupper($request["firstname"]);
        $new_patient->middlename = strtoupper($request["middlename"]);
        $new_patient->lastname = strtoupper($request["lastname"]);
        $new_patient->gender = strtoupper($request["gender"]);
        $new_patient->address = $request["address"];
        $new_patient->birth_date = $request["birth_date"];
        $new_patient->save();

        //success, error, info, warning
        Toastr::success('New Patient Record added successfully :)','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        $data = Transaction::where('patient_id', $id)->get();
        $stocks = Stock::where('in_stock', '>', '0')->whereDate('expiry_date', ">=", Carbon::today())->get();
        return view('patients.show', compact('patient', 'data', 'stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Personal Information";
        $data = Patient::find($id);
        return view('patients.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');

        $update_patient = Patient::find($id);
        $update_patient->firstname = strtoupper($request["firstname"]);
        $update_patient->middlename = strtoupper($request["middlename"]);
        $update_patient->lastname = strtoupper($request["lastname"]);
        $update_patient->gender = strtoupper($request["gender"]);
        $update_patient->address = $request["address"];
        $update_patient->birth_date = $request["birth_date"];
        $update_patient->save();

        //success, error, info, warning
        Toastr::success('Patient updated successfully :)','Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}