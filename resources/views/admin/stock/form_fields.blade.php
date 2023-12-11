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
        
        @if ($show_product== 1)
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
        @endif

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