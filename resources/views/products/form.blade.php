@extends('master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="text-uppercase"><a href="{{route('web::invoices')}}">< All
                            Invoices</a>&nbsp;/&nbsp;{{$invoice->name}} Items</h5>
                </div>
                <div class="col-sm-6 float-right">
                    <button class="btn btn-success float-right" data-toggle="modal" data-target="#addItem">Add Item</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($items->isNotEmpty())
                <table class="table table-borderless">
                    <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @foreach($items as $item)
                        <tr class="text-center">
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->product_price}}</td>
                            <td>{{$item->total}}</td>
                            <td>
                               <button  data-id="{{$item->id}}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteproduct">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        @include('products.item_modal')
        @include('products.delete_modal')
    </div>
@endsection
@section('js')
    <script>
        $('#deleteproduct').on('show.bs.modal', function(e){
            button = $(e.relatedTarget)
           id = button.data('id');
           modal = $(this);
           modal.find('.modal-body #product-id').val(id);
        });

    </script>
    @endsection