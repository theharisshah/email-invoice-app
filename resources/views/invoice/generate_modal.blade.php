<div class="modal fade" id="generatePdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Customer to continue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('web::invoice.generate')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="invoice-id">

                    <div class="col-sm-12 mt-1 form-group">
                        <label for="customer_name">Customer Name</label>
                        <input class="form-control" type="text" name="name"
                               placeholder="Enter Name">
                    </div>
                    <div class="col-sm-12 mt-1 form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="email">
                    </div>
                    <div class="col-sm-12 mt-1 form-group">
                        <label for="address">Address</label>
                       <textarea class="form-control" id="address" name="address" placeholder="address"></textarea>
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