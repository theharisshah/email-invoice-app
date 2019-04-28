@extends('master')

@section('content')

    <div class="card">

        <div class="card-body">
            <form action="{{route("web::invoice.store")}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="invoice_name">Name</label>
                    <input type="text" class="form-control" id="invoice_name" placeholder="Enter Invoice Name" name="name">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>


@endsection