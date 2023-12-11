@extends('layouts.app')


@section('content_header')
    <h1 class="m-0 text-dark">Products</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Products With Details</div>
        <div class="card-body">
            <!-- ========== Start Table ========== -->
            <table class="table table-bordered table-hover" id="productsTable">
                <thead class="table-head bg-light">
                    <th>Serial No.</th>
                    <th>Product Image</th>
                    <th>Product Name with Code</th>
                    <th>Cost</th>
                    <th>Quantity</th>
                    <th>Stock Status</th>
                    <th>Added By</th>
                    <th>Actions</th>
                </thead>
                <tbody class="table-body">
                    @foreach ($products as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><img src="{{ asset($item->image) }}" alt="Product Image" width="200px"></td>
                        <td>{{ $item->product_name }} <span class="badge">{{ $item->product_code }}</span></td>
                        <td>{{ $item->cost }}</td>
                        @if ($item->stock->isNotEmpty())
                            <td>{{ $item->stock->sum('quantity') }}</td>
                            <td>
                                @if ($item->stock->sum('quantity') <=0)
                                    OUT OF STOCK
                                @else
                                    IN STOCK
                                @endif
                            </td>
                        @else
                            <td>0</td>
                            <td>Doesn't Exists</td>
                        @endif
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <a href="{{ route('edit.product', $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                            <button type="button" data-id="{{ $item->id }}" data-url="{{ route('destroy.product', ['id' => $item->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete Product" class="btn btn-xs btn-danger btn-delete-product"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                 
            </table>
            <!-- ========== End Table ========== -->
            
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(function(){
            _delete('product', 'Product')
        });
    </script>
@endsection