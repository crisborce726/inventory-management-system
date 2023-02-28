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
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i> Add New</a>
                    @if(count($data) > 0)
                        <a class="btn btn-info btn-xs" target="_blank" href="{{ route('stocks.pdf') }}"><i class="fa fa-file-pdf "></i> PDF</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        
                        <table id="med" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>In Stock</th>
                                    <th>Unit</th>
                                    <th>Category</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->item}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->in_stock}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <!-- <span class="badge badge-danger"></span>-->
                                    <!-- Check date if expired-->
                                    <td>{{\Carbon\Carbon::parse($item->expiry_date)->format('F j,Y')}}</td>
                                    <td>
                                        <a href="{{route ('stocks.edit', $item->id) }}" class="btn btn-success btn-xs" title="Edit" ><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-xs delStock" data-stock_id={{$item->id}} data-toggle="modal" data-target="#delStock"><i class="fa fa-trash"></i></a>
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

    <!-- Stock Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stocks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label>Item</label>
                        <input class="form-control" type="text" name="item" id="item" required>
                    </div>

                    <div class="row mb-3">
                        <label>Description</label>
                        <input class="form-control" type="text" name="description" id="description" required>
                    </div>

                    <div class="row mb-3">
                        <label>Quantity</label>
                        <input class="form-control" type="number" name="qty" id="qty" required>
                    </div>

                    <div class="row mb-3">
                        <label>Unit</label>
                        <input class="form-control" type="text" name="unit" id="unit" required>
                        <small><i>e.g. Pc/s, Box/es</i></small>
                    </div>

                    <div class="row mb-3">
                        <label>Expiry Date</label>
                        <input class="form-control" type="date" name="expiry_date" id="expiry_date" min="@php echo date('Y-m-d'); @endphp" required>
                    </div>

                    <div class="row mb-3">
                        <label>Category</label>
                        <select  id="category_id" name="category_id" class="form-control" required>
                            <option value="" disabled selected>Select Category</option>
                            @php
                                $get = DB::table('categories')->get();
                                foreach($get as $value)
                                {
                                    echo "<option value=".$value->id.">$value->name</option>";
                                }
                            @endphp
                        </select>
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
    <!-- End of Stock Modal -->

    <!-- Delete Stock Modal -->
    <div class="modal fade" id="delStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stocks.delete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')                         

                        <div class="mb-3">
                            <p class="text-center">
                                Are you sure you want to delete this stock?
                            </p>
                            <input class="form-control" type="text" name="stock_id" id="stock_id" hidden>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                    <button type="submit" class="btn btn-warning">Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Stock Category Modal -->

@endsection