@extends('layouts.app')


@section('content_header')
    <h1 class="m-0 text-dark">Product Suppliers</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!--= list of Suppliers =-->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Available Suppliers</div>
                <div class="card-body">
                     <!--= data tables to show categories =-->
                     <table id="dataTabel" class="table table-bordered table-default">
                        <thead>
                            <th>Serial #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $key => $item)
                                <tr class="parent-row">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="#">{{ $item->phone }}</a>
                                        <a href="#">{{ $item->email }}</a>
                                    </td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <a href="{{ route('edit.supplier', $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                        <button type="button" data-id="{{ $item->id }}" data-url="{{ route('destroy.supplier', ['id' => $item->id]) }}" data-toggle="tooltip" data-placement="top" title="Delete Supplier" class="btn btn-xs btn-danger btn-delete-supplier"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                     <!--/= End data tables to show categories =-->
                </div>
            </div>
        </div>
        <!--/= End list of Suppliers =-->

        <!--= form to add Suppliers =-->
        <div class="col-md-5">
            <!--= [form #add_suppliers] =-->
            <form action="{{ route('store.supplier') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">Add New Supplier</div>
    
                    <div class="card-body">
                        {{-- Supplier Name field --}}
                        <div class="form-group">
                            <label for="name">Supplier Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Supplier Name" required>
                         
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{-- Supplier Phone field --}}
                        <div class="form-group ">
                            <label for="phone">Supplier Phone</label>
                            <input type="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" id="phone" placeholder="Enter Supplier Phone">
                         
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Supplier Email field --}}
                        <div class="form-group ">
                            <label for="email">Supplier Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="email" placeholder="Enter Supplier Email" required>
                         
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="form-group">
                            <label for="address">Supplier Address</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address') }}</textarea>
                            @error('address')
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
            <!--/= End [form #add_suppliers] =-->
        </div>
        <!--/= End form to add Suppliers =-->
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