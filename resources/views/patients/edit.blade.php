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
                    <a class="btn btn-info btn-xs" href="{{route ('patients.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                        
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('patients.update',$data->id) }}">
                        @csrf
                        @method('PUT')
                            <div class="mb-3">
                                <label>Firstname</label>
                                <input class="form-control" type="text" name="firstname" id="firstname" value="{{$data->firstname}}">
                            </div>

                            <div class="mb-3">
                                <label>Middlename</label>
                                <input class="form-control" type="text" name="middlename" id="middlename" value="{{$data->middlename}}">
                            </div>

                            <div class="mb-3">
                                <label>Lastname</label>
                                <input class="form-control" type="text" name="lastname" id="lastname" value="{{$data->lastname}}">
                            </div>

                            <div class="mb-3">
                                <label>Gender</label>
                                <input class="form-control" type="text" name="gender" id="gender" value="{{$data->gender}}">
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" id="address" value="{{$data->address}}">
                            </div>

                            <div class="mb-3">
                                <label>Birthday</label>
                                <input class="form-control" type="date" name="birth_date" id="birth_date" value="{{$data->birth_date}}">
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