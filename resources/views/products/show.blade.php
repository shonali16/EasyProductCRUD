@extends('products.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded" style="background-color: #f4f6f9;">
        <h2 class="card-header text-center text-white" style="background-color: #006a7b; font-weight:normal;">
            Product Details - Laravel 11 CRUD By Sonali
        </h2>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('products.index') }}" class="btn" style="background-color: #4a7c7f; color: white;">Back to Products</a>
            </div>

            <div class="mb-3">
                <h5>Name: {{ $product->name }}</h5>
                <p><strong>Details:</strong> {{ $product->detail ?? 'No details available' }}</p>
            </div>

            <div class="d-flex justify-content-end">
         
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
