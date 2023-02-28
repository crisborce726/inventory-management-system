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
                <div class="float-right">
                    <a class="btn btn-info btn-xs" href="{{route ('stocks.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                        
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('stocks.update',$data->id) }}">
                        @csrf
                        @method('PUT')
                            <div class="mb-3">
                                <label>Item</label>
                                <input class="form-control" type="text" name="item" id="item" value="{{$data->item}}">
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" id="description" value="{{$data->description}}">
                            </div>

                            <div class="mb-3">
                                <label>Stock</label>
                                <input class="form-control" type="number" name="in_stock" id="in_stock" value="{{$data->in_stock}}">
                            </div>

                            <div class="mb-3">
                                <label>Unit</label>
                                <input class="form-control" type="text" name="unit" id="unit" value="{{$data->unit}}">
                            </div>

                            <div class="mb-3">
                                <label>Expiry Date</label>
                                <input class="form-control" type="date" name="expiry_date" id="expiry_date" value="{{$data->expiry_date}}">
                            </div>

                            <div style="text-align: right">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit Form <i class="fa fa-paper-plane"></i></button>
                            </div>
                    </form>

                    </div>
                    <div class="col-md-3">
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection