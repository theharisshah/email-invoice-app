<html>
<head>
    <script
            src="https://code.jquery.com/jquery-3.4.0.min.js"
            integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
            crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"
            integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            Invoice No # {{$invoice->name}}
        </div>
        <div class="col-sm-6">
           Dated: {{\Carbon\Carbon::parse($invoice->date)->toFormattedDateString()}}
        </div>
    </div>
    <table class="table table-borderless">
        <thead class="thead-dark">
        <th>Customer Name</th>
        <th>Address</th>
        <th>Email</th>
        </thead>
        <tbody>
        <tr class="text-center">
            <td>{{$invoice->customer->name}}</td>
            <td>{{$invoice->customer->address}}</td>
            <td>{{$invoice->customer->email}}</td>
        </tr>
        </tbody>
    </table>
    <table class="table table-borderless">
        <thead class="thead-dark">
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit-Price</th>
        <th>Total</th>
        </thead>

        @foreach($invoice->items as $item)
            <tr class="text-center">
                <td>{{$item->product_name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->product_price}}</td>
                <td>{{$item->total}}</td>
            </tr>
        @endforeach
        <tr class="text-center">
            <td></td>
            <td></td>
            <td class="font-weight-bold">Grand Total</td>
            <td>{{$invoice->items->sum('total')}}</td>
        </tr>
    </table>
    <p>{{$invoice->description}}</p>
</div>
</body>

</html>