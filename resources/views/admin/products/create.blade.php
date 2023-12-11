@extends('layouts.app')


@section('content_header')
    <h1 class="m-0 text-dark">Add Product</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--= Form Card =-->
                <div class="card">

                    <div class="card-body">
                       {{-- Product Name field --}}
                       <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" name="product_name" id="product_name" placeholder="Enter Product Name" required>
                        
                        @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       </div>

                       {{-- Product Category field --}}
                       <div class="form-group">
                        <label for="category_id">Product Category</label>
                        <select name="category_id" id="category_id" class="form-control select2 @error('category_id') is-invalid @enderror" autocomplete="off" required>
                            <option value="">Choose Category</option>
                            @foreach ($categories as $key => $item)
                                <option value="{{ $item->id }}" {{ $item->id == old('category_id') ? 'selected' : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                        
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       </div>

                       {{-- Product Code field --}}
                       <div class="form-group">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code') }}" name="product_code" id="product_code" placeholder="Enter Product Code" required>
                        <span class="help-block" style="color:var(--info)">Product Code should be unique</span>

                        @error('product_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       </div>

                       {{-- Product Cost field --}}
                       <div class="form-group">
                        <label for="cost">Product Cost</label>
                        <input type="number" min="0.00" max="100000.00" step="0.01" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost') }}" name="cost" id="cost" placeholder="Enter Product Cost" required>
                        
                        @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       </div>

                       <!--= Image Uploading =-->
                       <div class="form-group">
                        <div class="featured-image-input">
                            <x-adminlte-input-file name="image" value="{{ old('image') }}" required="true" label="Product Photo" placeholder="Choose a file..." disable-feedback/>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between" style="background: var(--light)">
                            <img src="{{ old('image') }}" alt="Featured Image"  class="img-fluid mt-1" style="display:none;max-height: 200px;" id="productImg">
                            <button type="button" class="btn btn-danger btn-sm resetImage" style="display:none;" ><i class="fa fa-trash"></i></button>
                        </div>

                       </div>
                       <!--/= End Image Uploading =-->

                       {{-- Product Detail --}}
                       <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i></button>
                    </div>
                </div>
                <!--/= End Form Card =-->
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script>
        $(function() {
            $(document).on('click', '.deleteItem', function () {
                var id = $(this).data('item_id');
                $('#productImageDiv'+id).remove();
            })

            $(document).on('click', '.resetImage', function () {
                $('#productImg').hide();
                $('.featured-image-input').show();
                $('.resetImage').hide();
                $('#productImg').attr('src', '');
                $('input[name="image"]').val('');
                $('label[for="image"]').text('Choose a file...');
            })

            $('input[name="image"]').change(function() {
                // Check if a file has been selected
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Set the source of the img element with ID "productImg"
                        $('#productImg').attr('src', e.target.result);
                        // Show the img element
                        $('#productImg').show();
                        // show the button
                        $('.resetImage').show();
                        // Hide the "featured-image-input" div
                        $('.featured-image-input').hide();
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection