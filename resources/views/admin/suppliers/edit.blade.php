@extends('layouts.app')

@section('content_header')
    <h1 class="m-0 text-dark">
        <a href="{{ route('all.suppliers') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i></a>
        Update Supplier
    </h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 m-auto">
                <!--= [form #add_suppliers] =-->
                <form action="{{ route('update.supplier', $data->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">Add New Supplier</div>

                        <div class="card-body">
                            {{-- Supplier Name field --}}
                            <div class="form-group">
                                <label for="name">Supplier Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $data->name) }}" name="name" id="name" placeholder="Enter Supplier Name" required>
                            
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            {{-- Supplier Phone field --}}
                            <div class="form-group ">
                                <label for="phone">Supplier Phone</label>
                                <input type="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $data->phone) }}" name="phone" id="phone" placeholder="Enter Supplier Phone">
                            
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Supplier Email field --}}
                            <div class="form-group ">
                                <label for="email">Supplier Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $data->email) }}" name="email" id="email" placeholder="Enter Supplier Email" required>
                            
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="address">Supplier Address</label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $data->address) }}</textarea>
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
        </div>
    </div>
@endsection