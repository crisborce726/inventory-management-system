@extends('layouts.app')
@section('title','Patient List | I.M.S.')

@section('content')
    <!-- Content Header (Page header) -->
    @section('page_title')
    {!!$patient->firstname!!} {!!$patient->middlename!!} {!!$patient->lastname!!}
        @section('active')
            {!!$patient->firstname!!}
        @endsection
    @endsection
    <!-- /.container-fluid -->
    
    <section class="content">        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaction</h3>
                <div class="float-right">
                    <a class="btn btn-info btn-xs" href="{{route ('patients.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('includes.messages')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                            Add Transaction
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('transactions.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                                  
                                        <div class="row mb-2">
                                            <label>Medicine</label>
                                            <select  id="stock_id" name="stock_id" class="form-control" required>
                                                <option value="" disabled selected>Select Item</option>
                                                    @foreach($stocks as $item)
                                                        <option value="{{$item->id}}">{{$item->item}}</option>
                                                    @endforeach
                                            </select>
                                        </div>

                                        <div class="row mb-2">
                                            <label>Qty.</label>
                                            <input id="qty" type="number" class="form-control" name="qty" required>
                                        </div>

                                        <div class="row">
                                            <input id="patient_id" type="number" class="form-control" name="patient_id" value="{!!$patient->id!!}" hidden>
                                        </div>     

                                        <div class="row float-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                                <b>ADD</b>
                                            </button>
                                        </div>
                                                
                                        
                                </form>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <div class="col-md-9">
                        <table id="patient_transac" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Qty.</th>
                                    <th>Released By</th>
                                    <th>Date Released</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->stock->item}}</td>
                                        <td>{{$item->stock->description}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('M j,Y')}}</td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection