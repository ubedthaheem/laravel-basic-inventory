@extends('layouts.app')

@section('content_header')
    <h1 class="m-0 text-dark">
        <a href="{{ route('all.stock') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i></a>
        Add Stock
    </h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 m-auto">
                <!--= [form #add_Stock] =-->
                <form action="{{ route('store.stock') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">Add New Stock</div>
        
                        <div class="card-body">
                            

                            {{-- Supplier field --}}
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control select2 @error('supplier_id') is-invalid @enderror" autocomplete="off" required>
                                    <option value="">Choose Supplier</option>
                                    @foreach ($suppliers as $key => $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('supplier_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            
                                @error('supplier_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Product field --}}
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="form-control select2 @error('product_id') is-invalid @enderror" autocomplete="off" required>
                                    <option value="">Choose Product</option>
                                    @foreach ($products as $key => $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('product_id') ? 'selected' : '' }}>{{ $item->product_name }}</option>
                                    @endforeach
                                </select>
                            
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <!--= row for quantity and date =-->
                            <div class="row">
                                {{-- Quantity field --}}
                                <div class="form-group col-6">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" name="quantity" id="quantity" placeholder="Enter Quantity" required>
                                
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="added_at">Date</label>
                                    <input type="date" name="added_at" class="form-control @error('added_at') is-invalid @enderror" id="added_at" required>
                                    @error('added_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!--/= End row for quantity and date =-->

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