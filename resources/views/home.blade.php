@extends('layouts.app')


@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $item)
        <div class="col-md-3">
            <div class="card" style="height:300px;">
                <div class="card-img-top text-center" >
                    <img class="img-fluid" style="height:180px;" src="{{ asset($item->image) }}" alt="Title" />
                </div>
                <div class="card-body p-2">
                    <h4 class="card-title text-bold">{{ $item->product_name }}</h4>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <h6 class="text-bold">{{ $item->cost }} AED</h6>
                    <button type="button" class="btn btn-primary btn-sm float-end">Buy Now</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection