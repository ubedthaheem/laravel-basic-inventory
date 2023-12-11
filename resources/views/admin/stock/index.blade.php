@extends('layouts.app')


@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="m-0 text-dark">Product Stock</h1>
        <div class="buttons">
            <a href="{{ route('create.stock') }}" class="btn btn-sm btn-info"><i class="fa fa-plus m-2"></i>Add New Stock</a>
        </div>
    </div>
@stop

@section('content')
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<div class="container-fluid">
    <div class="row">
        <!--= list of Stock =-->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Available Stock</div>
                <div class="card-body">
                     <!--= data tables to show Stock =-->
                     <table id="dataTabel" class="table table-bordered table-default">
                        <thead>
                            <th>Serial #</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Quantity Added</th>
                            <th>Last Added Date</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($stock as $key => $item)
                                <tr class="parent-row">
                                    <td>{{ $key+1 }}</td>
                                    
                                    <td>
                                        <span>{{ $item->product->product_name }}</span>
                                       <span class="badge">{{ $item->product->product_code }}</span>
                                    </td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->added_at }}</td>
                                    <td>
                                        <a href="{{ route('edit.stock', $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                     <!--/= End data tables to show Stock =-->
                </div>
            </div>
        </div>
        <!--/= End list of Stock =-->
 
    </div>
</div>
@endsection

@section('plugins.Datatables', true)

@section('js')
    <script>
        $(function () {
            $('#dataTabel').dataTable();
            _delete('supplier', 'Supplier');

              
        }) 
    </script>
@endsection