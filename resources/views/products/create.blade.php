@extends('layouts/layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded" style="background-color: #f9f9f9;">
        <h2 class="card-header text-center" style="background-color: #e9ecef; color: #495057;">
            Create New Product
        </h2>
        <div class="card-body">
            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Product creation form --}}
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    {{-- Display error for name field --}}
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="detail" class="form-label">Detail</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3">{{ old('detail') }}</textarea>
                    {{-- Display error for detail field --}}
                    @error('detail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
