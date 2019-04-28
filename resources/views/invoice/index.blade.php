@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <span class="text-uppercase text-monospace">All Invoices</span>
                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">
                    <a href="{{route('web::invoice.create')}}" class="btn btn-success float-right">Create Invoice</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-borderless table-hover">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th>Name</th>
                    <th>Customer name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Add Products</th>
                    <th>Send Invoice</th>
                    <th>Edit Invoice</th>
                    <th>View Invoice</th>
                </tr>
                </thead>
                <tbody>
                @if($invoices->isNotEmpty())
                    @foreach($invoices as $invoice)
                        <tr class="text-center mt-2">
                            <td>{{$invoice->name}}</td>
                            <td>{{(!empty($invoice->customer))?$invoice->customer->name:'Not set yet'}}</td>
                            <td>{{\Carbon\Carbon::parse()->toFormattedDateString()}}</td>
                            <td class="text-uppercase">{{$invoice->status}}</td>
                            <td><a href="{{route('web::invoice-products', ['id'=>$invoice->id])}}"
                                   class="btn btn-sm btn-primary">Add/Remove Items</a></td>
                            <td>
                                <a href="{{route('web::email.invoice', ['id'=>$invoice->id])}}" class="btn btn-sm btn-success">Send Invoice</a>
                            </td>
                            <td><a href="{{route('web::invoice.edit', ['id'=>$invoice->id])}}"
                                   class="btn btn-sm btn-light">Edit Invoice</a></td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#generatePdf"
                                        data-id="{{$invoice->id}}">Generate PDF
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-uppercase text-muted">No Invoices Yet!</td>

                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('invoice.generate_modal')
    </div>

@endsection
@section('js')
    <script>
        $('#generatePdf').on('show.bs.modal', function (e) {
            button = $(e.relatedTarget);
            id = button.data('id');
            modal = $(this);
            test = modal.find('.modal-body #invoice-id').val(id);
            console.log(test);
        });
    </script>
@endsection