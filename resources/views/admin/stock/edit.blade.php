@extends('layouts.app')

@section('content_header')
    <h1 class="m-0 text-dark">
        <a href="{{ route('all.stock') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i></a>
        Update Stock
    </h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 m-auto">
                <!--= [form #add_Stock] =-->
                <form action="{{ route('update.stock', $info->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">Update Stock</div>
        
                        <div class="card-body" id="cardBody">
                            

                            <!--= row for product & supplier information =-->
                            <div class="row">
                                {{-- Supplier field --}}
                                <div class="form-group col-6">
                                    <label for="supplier_id1">Supplier</label>
                                    <input type="text" id="supplier_id1" class="form-control" value="{{ $info->supplier->name }}" disabled>
                                </div>

                                {{-- Product field --}}
                                <div class="form-group col-6">
                                    <label for="product_id1">Product</label>
                                    <input type="text" id="product_id1" value="{{ $info->product->product_name }}" class="form-control" disabled>
                                    <input type="hidden" name="product_id" value="{{ $info->product_id }}">
                                </div>
                            </div>
                            <!--/= End row for product & supplier information =-->


                            <!--= row for quantity and date =-->
                            <div class="row">
                                {{-- Quantity field --}}
                                <div class="form-group col-6">
                                    <label for="quantity1">Quantity</label>
                                    <input type="number" class="form-control" value="{{ $info->quantity }}" id="quantity1" placeholder="Enter Quantity" disabled>
                                </div>

                                <div class="form-group col-6">
                                    <label for="added_at1">Date</label>
                                    <input type="date" id="added_at1" class="form-control" value="{{ $info->added_at }}" disabled>
                                    
                                </div>
                            </div>
                            <!--/= End row for quantity and date =-->

                            <!--= Button to Add 2nd Row =-->
                            <button type="button" class="btn btn-info btn-block my-2 btn-add-more"><i class="fa fa-plus m-2"></i>Add More</button>
                            <!--/= End Button to Add 2nd Row =-->


                        </div>

                        <!--= form-footer =-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-md btn-success"><i class="fa fa-save"></i></button>
                        </div>
                        <!--/= End form-footer =-->
                    </div>
                </form>
                <!--/= End [form #add_suppliers] =-->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            $('.btn-add-more').on('click', function () {
                // show new data into the view
                // get that data from Ajax
                /// Ajax Request for Getting Form Fields
                $.ajax({
                    url:'{{ route('form-fields.stock') }}',
                    type:'post',
                    data:{product_show:0},
                    headers: {
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function (){
                        /// do domthing
                        $('.btn-add-more').remove();
                        $('#cardBody').append('<div id="loading">Please wait...</div>')
                    },
                    success: function (response){
                        console.log('success called on ajax request of Getting Form Fields')
                        $('#loading').remove();
                        $('#cardBody').append(response);
                        
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        console.error('error called on ajax request of Getting Form Fields')
                        console.error(xhr.status)
                        console.error(thrownError)
                    }
                });
            })
        });
    </script>
@endsection