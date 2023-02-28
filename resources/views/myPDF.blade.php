<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hi, {{$title}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('images/Logo.png')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            
            <center>
                <img src="{{ asset('images/Logo.png') }}" style="width: 70px; height: 70px"><br>
                <p class="m-0">Republic of the Philippines</p>
                <p class="m-0">Cordillera Administrative Region</p>
                <p class="m-0">Province of Abra</p>
                <p class="m-0">MUNICIPALITY OF VILLAVICIOSA</p>
                <p class="m-0"><b>RURAL HEALTH UNIT</b></p>
            </center>
        </div>
    </div>

    <hr style="background-color: black">

    LIST OF MEDICINES AND OTHER SUPPLIES ON-HAND
    (as of {{\Carbon\Carbon::parse(today())->format('F j,Y')}})

    <table class="table table-bordered">
        <thead style="background-color: #add8e6">
            <tr>
                <th>No.</th>
                <th style="width:25%">Item</th>
                <th>Description</th>
                <th>Qty.</th>
                <th>Unit</th>
                <th>Category</th>
                <th style="width:15%">Expiry Date</th>
                
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($data as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->item}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->in_stock}}</td>
                <td>{{$item->unit}}</td>
                <td>{{$item->category->name}}</td>
                <!-- <span class="badge badge-danger"></span>-->
                <!-- Check date if expired-->
                <td>{{\Carbon\Carbon::parse($item->expiry_date)->format('F j,Y')}}</td>
            </tr>
            @php $i ++;  @endphp
            @endforeach
        </tbody>
    </table>

    @if(count($data) == 0)
    <center>No data available in table.</center>
    @endif

    <div class="mb-5">
        Prepared by:
    </div>

    <b><u>{{strtoupper($user->name)}}<u></b><br>
    <i>{{$user->position}}</i>
</body>
</html>