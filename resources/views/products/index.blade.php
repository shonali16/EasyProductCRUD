@extends('layouts/layout')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded" style="background-color: #f4f6f9;">
        <h2 class="card-header text-center text-white" style="background-color: #006a7b; font-weight:normal">Laravel 11 CRUD By Sonali</h2>
        <div class="card-body">
            <div class="mb-3 text-end">
                <a href="{{ route('products.create') }}" class="btn" style="background-color: #4a7c7f; color: white;">Add Product</a>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-light" style="background-color: #e9ecef;">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr style="background-color: #f8f9fa;">
                    <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                        <td>
                            <span class="editable" data-field="name" data-product-id="{{ $product->id }}" style="cursor:pointer;">
                                {{ $product->name }}
                            </span>
                            <input type="text" class="form-control edit-input" style="display:none;" value="{{ $product->name }}" data-field="name" data-product-id="{{ $product->id }}">
                            <button class="btn btn-success btn-sm" style="display:none;" data-product-id="{{ $product->id }}">Save</button>
                        </td>
                        <td>
                        <span class="editable" data-field="detail" data-product-id="{{ $product->id }}" style="cursor:pointer;">
                            {{ $product->detail }}
                        </span>
                        <input type="text" class="form-control edit-input" style="display:none;" value="{{ $product->detail }}" data-field="detail" data-product-id="{{ $product->id }}">
                        <button class="btn btn-success btn-sm" style="display:none;" data-product-id="{{ $product->id }}">Save</button>
                        </td>
                        
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm" style="background-color: #006a7b;" >View</a>
        
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $products->links('pagination::bootstrap-5') !!}

            
        </div>
    </div>
</div>  <!-- Closing div tag for the container -->

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Show input field and Save button when editable span is clicked
    $('.editable').on('click', function() {
        const $this = $(this);
        const $inputField = $this.next('.edit-input');
        const $saveButton = $inputField.next('.btn-success');

        $this.hide();
        $inputField.show().focus();
        $saveButton.show();
    });

    // Handle Save button click
    $('.btn-success').on('click', function() {
        const $this = $(this);
        const productId = $this.data('product-id');
        const $inputField = $this.prev('.edit-input');
        const field = $inputField.data('field');
        const newValue = $inputField.val();

        updateProduct(productId, field, newValue, $this);
    });

    // Function to update product
    function updateProduct(productId, field, newValue, $saveButton) {
        $.ajax({
            url: `/products/${productId}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'POST',
                [field]: newValue,
            },
            success: function(response) {
                if (response.success) {
                    const $editable = $saveButton.prevAll('.editable').first();
                    $editable.text(newValue);
                    $saveButton.hide();
                    $saveButton.prev('.edit-input').hide();
                    $editable.show();
                } else {
                    alert('Failed to update the product.');
                }
            },
            error: function() {
                alert('An error occurred while updating the product.');
            }
        });
    }
});
</script>
@endpush

