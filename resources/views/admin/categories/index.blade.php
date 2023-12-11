@extends('layouts.app')


@section('content_header')
    <h1 class="m-0 text-dark">Product Categories</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!--= list of categories =-->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Available Categories</div>
                <div class="card-body">
                     <!--= data tables to show categories =-->
                     <table id="dataTabel" class="table table-bordered table-default">
                        <thead>
                            <th>Serial #</th>
                            <th>Category</th>
                            <th>Detail</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($category_list as $key => $item)
                                <tr class="parent-row">
                                    <td>
                                        {{ $key+1 }}
                                        @if ($item->children->isNotEmpty())
                                            <button type="button" id="{{ $item->id }}" class="btn btn-xs btn-secondary toggle-child-rows"><i class="fa fa-plus"></i></button>
                                        @endif
                                        
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ route('edit.category', $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                        <button type="button" data-id="{{ $item->id }}" data-url="{{ route('destroy.category', ['id' => $item->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete Category" class="btn btn-xs btn-danger btn-delete-category"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!--= Child loop =-->
                                
                                @foreach ($item->children as $k => $child)
                                    <tr class="child-row child_{{ $item->id }} bg-secondary" style="display: none;">
                                        <td>{{ $child->id }}</td>
                                        <td>{{ $child->title }}</td>
                                        <td>{{ $child->description }}</td>
                                        <td>
                                            <a href="{{ route('edit.category', $child->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            <button type="button" data-id="{{ $child->id }}" data-url="{{ route('destroy.category', ['id' => $child->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete Category" class="btn btn-xs btn-danger btn-delete-category"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                               
                                <!--/= End Child loop =-->
                            @endforeach
                        </tbody>
                     </table>
                     <!--/= End data tables to show categories =-->
                </div>
            </div>
        </div>
        <!--/= End list of categories =-->

        <!--= form to add category =-->
        <div class="col-md-5">
            <!--= [form #add_category] =-->
            <form action="{{ route('store.category') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Add New Category</div>
    
                    <div class="card-body">
                        {{-- Category Name field --}}
                        <div class="form-group ">
                            <label for="title">Category Name</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" id="title" placeholder="Enter Category Name" required>
                         
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Category Slug field --}}
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" name="slug" id="slug" placeholder="Enter Category Slug">
                         
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
                                    <option value="{{ $item->id }}" {{ $item->id == old('parent_id') ? 'selected' : '' }}>{{ $item->title }}</option>
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
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ old('description') }}</textarea>
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
        <!--/= End form to add category =-->
    </div>
</div>
@endsection

@section('plugins.Datatables', true)

@section('js')
    <script>
        $(function () {
            $('#dataTabel').dataTable();
            _delete('category', 'Category');

            // child categories display
            $('.toggle-child-rows').on('click', function() {
                var id = $(this).attr('id');
                
                var childRows = $('tr.child_'+id);
                
                if (childRows.length) {
                    childRows.toggle();
                }
            });
            
            // on keyup fill slug 
            $('#title').on('keyup', function () {
                // 
                const title = $('#title').val();
                const sanitizedTitle = removeSpecialCharacters(title);
                $('#slug').val(sanitizedTitle.replace(/\s+/g, '-'))
            });

            // enable slug field on click
            

            $(document).ready(function () {
                $('#slug').on('click', function () {
                    $(this).prop('disabled', false);
                })
            })
        })

        function removeSpecialCharacters(str) {
            return str.replace(/[^\w\s]/gi, '').toLowerCase();
        }
    </script>
@endsection