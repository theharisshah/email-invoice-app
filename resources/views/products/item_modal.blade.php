<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('web::invoice-product.store')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

                    <div class="col-sm-12 mt-1 form-group">
                        <label for="product_name">Product Name</label>
                        <input class="form-control" type="text" name="product_name"
                               placeholder="Enter Product Name">
                    </div>
                    <div class="col-sm-12 mt-1 form-group">
                        <label for="quantity">Quantity</label>
                        <input class="form-control" type="number" name="quantity" placeholder="quantity">
                    </div>
                    <div class="col-sm-12 mt-1 form-group">
                        <label for="product_price">Unit Price</label>
                        <input class="form-control" type="number" step="any" name="product_price"
                               placeholder="unit price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>