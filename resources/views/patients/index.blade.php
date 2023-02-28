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
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i> Add New Patient Record</a>
                </div>
            </div>
            <div class="card-body">
                    <div class="col-md-12">
                        <div class="">
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Birthday</th>
                                        <th>Age</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->lastname}}, {{$item->firstname}} {{$item->middlename}}</td>
                                        <td>{{$item->gender}}</td> 
                                        <td>{{$item->address}}</td> 
                                        <td>{{\Carbon\Carbon::parse($item->birth_date)->format('F j,Y')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->birth_date)->age }}</td>  
                                        <td>
                                            <a href="{{route ('patients.edit', $item->id) }}" class="btn btn-success btn-xs" title="Edit" ><i class="fa fa-edit"></i></a>
                                            <a href="{{route ('patients.show', $item->id) }}" class="btn btn-warning btn-xs" title="Add Transactions" >
                                                <i class="fa fa-plus"> Add</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <!-- Archive Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add new Patient Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label>Firstname</label>
                        <input class="form-control" type="text" name="firstname" id="firstname" required>
                    </div>

                    <div class="row mb-3">
                        <label>Middlename</label>
                        <input class="form-control" type="text" name="middlename" id="middlename">
                    </div>

                    <div class="row mb-3">
                        <label>Lastname</label>
                        <input class="form-control" type="text" name="lastname" id="lastname" required>
                    </div>

                    <div class="row mb-3">
                        <label>Gender</label>
                        <select  id="gender" name="gender" class="form-control @error('gender') is-valid @enderror" value="{{old('gender')}}">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <label>Address</label>
                        <input class="form-control" type="text" name="address" id="address" required>
                    </div>

                    <div class="row mb-3">
                        <label>Birth Date</label>
                        <input class="form-control" type="date" name="birth_date" id="birth_date" max="@php echo date('Y-m-d'); @endphp" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Archive Modal -->

@endsection