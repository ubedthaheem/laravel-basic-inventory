@extends('layouts.app')


@section('content_header')
    <h1 class="m-0 text-dark">
        <a href="{{ route('all.categories') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i></a>
        Product Categories
    </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 m-auto">
                <!--= [form #add_category] =-->
                <form action="{{ route('update.category', $data->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">Add New Category</div>
        
                        <div class="card-body">
                            {{-- Category Name field --}}
                            <div class="form-group ">
                                <label for="title">Category Name</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $data->title) }}" name="title" id="title" placeholder="Enter Category Name" required>
                            
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Category Slug field --}}
                            <div class="form-group">
                                <label for="slug">Category Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $data->slug) }}" name="slug" id="slug" placeholder="Enter Category Slug">
                            
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Parent Category field --}}
                            @isset($categories)
                            <div class="form-group ">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control select2 @error('parent_id') is-invalid @enderror" autocomplete="off">
                                    <option value="">Choose Parent Category</option>
                                    @foreach ($categories as $key => $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('parent_id', $data->parent_id) ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            
                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endisset

                            <div class="form-group">
                                <label for="description">Category Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ old('description', $data->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--= form-footer =-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-md btn-success"><i class="fa fa-save"></i></button>
                        </div>
                        <!--/= End form-footer =-->
                    </div>
                </form>
                <!--/= End [form #add_category] =-->
            </div>
        </div>
    </div>
@endsection