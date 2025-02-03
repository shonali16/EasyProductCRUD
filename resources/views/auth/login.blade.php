 @extends('layouts.app')

@section('content') 
<div class="max-w-md mx-auto bg-white p-8 shadow-md rounded-md d-flex">
    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

    @if ($errors->any())
        <div class="text-red-500 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="block w-full mt-1 border border-gray-300 rounded-md p-2" value="{{ old('email') }}" required autofocus />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="block w-full mt-1 border border-gray-300 rounded-md p-2" required />
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Login
            </button>
        </div>
    </form>
</div>
@endsection
