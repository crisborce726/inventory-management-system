@extends('layouts.app')
@section('title',$title . ' | I.M.S.')

@section('content')

    <!-- Content Header (Page header) -->
    @section('page_title')
    {!!$title!!}
        @section('active')
            {!!$title!!}
        @endsection
    @endsection
    <!-- /.container-fluid -->
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$patients}}</h3>

                        <p>Patients</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                        <a href="{{route('patients.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$categories}}</h3>

                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                        <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$stocks}}</h3>

                        <p>Stocks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                        <a href="{{route('stocks.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$transactions}}</h3>

                        <p>Transactions</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                        <a href="{{route('transactions.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <section class="col-6">
                <!-- Default box -->
                <div class="card"><!-- Card -->
                    <div class="card-header"><!-- Card Header -->
                        <h3 class="card-title">{!!$title!!}</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $transac->container() !!}
                        </div>

                        <script src="{{ $transac->cdn() }}"></script>
                        {{ $transac->script() }}
                        
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </section><!-- /.col-12 -->

            <section class="col-6">
                <!-- Default box -->
                <div class="card"><!-- Card -->
                    <div class="card-header"><!-- Card Header -->
                        <h3 class="card-title">Recently Added Stocks</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">

                        <div class="table-responsive">
                        
                            <table id="recent" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>In Stock</th>
                                        <th>Unit</th>
                                        <th>Category</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($new_data as $item)
                                    <tr>
                                        <td>{{$item->item}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->in_stock}}</td>
                                        <td>{{$item->unit}}</td>
                                        <td>{{$item->category->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </section><!-- /.col-12 -->

        </div><!-- /.row -->

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card"><!-- Card -->
                <div class="card-header">
                    <h3 class="card-title">Expired Medicine</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table id="datatables" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>In Stock</th>
                                    <th>Unit</th>
                                    <th>Category</th>
                                    <th>Expiry Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expired_data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->item}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->in_stock}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <!-- <span class="badge badge-danger"></span>-->
                                    <!-- Check date if expired-->
                                    <td>
                                        <span class="badge badge-danger">
                                            {{\Carbon\Carbon::parse($item->expiry_date)->format('F j,Y')}}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
    
@endsection