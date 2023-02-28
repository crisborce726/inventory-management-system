@extends('layouts.app')
@section('title',$title . ' List | I.M.S.')

@section('content')
    <!-- Content Header (Page header) -->
    @section('page_title')
    {!!$title!!}
        @section('active')
            {!!$title!!}
        @endsection
    @endsection
    <!-- /.container-fluid -->
    
    <section class="content">        
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    Add New User
                </div>
            </div>
            <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                        <th>Qty.</th>
                                        <th>Patient</th>
                                        <th>Date Released</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->stock->item}}</td>
                                        <td>{{$item->quantity}}</td> 
                                        <td>{{$item->patient->lastname}}, {{$item->patient->firstname}} {{$item->patient->middlename}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('F j,Y')}}</td>
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