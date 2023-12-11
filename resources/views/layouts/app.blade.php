@extends('adminlte::page')

@if (session()->has('message'))
    <script>
        var message = '{{ session('message') }}'
        var type = '{{ session('type') }}'
        toastr.type(message)
    </script>
@endif

@push('content')
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endpush

@section('adminlte_js')
@yield('js')

<script>
    function _delete(buttonClass, itemName, confirmFirst = false) 
    {
        console.log("buttonClass, itemName, confirmFirst" + buttonClass + itemName + confirmFirst);
        
        $(document).on('click', '.btn-delete-'+buttonClass, function (e) {
            e.preventDefault();
            var button = $(this);
            var row = button.closest('tr');
            var itemId = button.data('id');
            var itemUrl = button.data('url');
            /// Ajax Request for Delete Slider
            $.ajax({
                url: itemUrl,
                type:'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // If you're using CSRF protection
                },
                beforeSend: function (){
                    button.attr('disabled', true)
                    if(confirmFirst == true){
                        return confirm("Are you sure? all the related data to the "+itemName+" will be permanently deleted");
                    }
                },
                success: function (response){
                    row.remove();
                    if(response.type === 'success'){
                        toastr.success(response.message)
                    }else{
                        toastr.error(response.message)
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    console.error('error called on ajax request of Delete ' + itemName)
                    console.error(xhr.status)
                    button.attr('disabled', false)
                    toastr.error(xhr.responseJSON.message)
                }
            });
        })
    }

    function _restore(buttonClass, itemName, confirmFirst = false)
    {
        $(document).on('click', '.btn-rollback-'+buttonClass, function () {
            var button = $(this);
            var row = button.closest('tr');
            var itemUrl = button.data('url')
            /// Ajax Request for Rollback Poetry
            $.ajax({
            url:itemUrl,
            type:'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // If you're using CSRF protection
            },
            beforeSend: function (){
                /// do domthing
                button.attr('disabled', true)
                if(confirmFirst == true){
                    return confirm("Are you sure? all the related data to the "+itemName+" will be restored");
                }
            },
            success: function (response){
                if(response.type === 'success'){
                toastr.success(response.message)
                }else{
                toastr.error(response.message)
                }
                row.remove()
            },
            error: function (xhr, ajaxOptions, thrownError){
                button.attr('disabled', false)
                console.error('error called on ajax request of Rollback '+itemName)
                console.error(xhr.status)
                console.error(thrownError)
                toastr.error(ajaxOptions.message + '<br>' + xhr.status)
            }
            });
        })
    }

    // change visibility
    function _visible(params) {
        
    }
</script>
@endsection