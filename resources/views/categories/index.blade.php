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
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i> Add New Category</a>
                </div>
            </div>
            <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            
                            <table id="datatables" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->created_by)->format('F j,Y')}}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs updateCat" data-cat_id={{$item->id}} data-name={{$item->name}} data-toggle="modal" data-target="#updateCat"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-xs delCat" data-cat_id={{$item->id}} data-toggle="modal" data-target="#delCat"><i class="fa fa-trash"></i></a>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <label>Name</label>
                        <input class="form-control" type="text" name="name" id="name" required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Add Category Modal -->

    <!-- Edit Category Modal -->
    <div class="modal fade" id="updateCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        <label>Name</label>
                        <input class="form-control" type="text" name="cat_id" id="cat_id" hidden>
                        <input class="form-control" type="text" name="update_name" id="update_name">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Edit Category Modal -->

    <!-- Delete Category Modal -->
    <div class="modal fade" id="delCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.delete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')                         

                        <div class="mb-3">
                            <p class="text-center">
                                Are you sure you want to delete this category?
                            </p>
                            <input class="form-control" type="text" name="cat_id" id="cat_id" hidden>
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
    <!-- End of Delete Category Modal -->

@endsection