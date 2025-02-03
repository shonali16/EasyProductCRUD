<nav class="bg-gray-900 p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="text-white text-lg font-semibold">Laravel App</a>

        <div class="flex items-center space-x-6">
            @auth
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-700 text-black px-4 py-2 rounded hover:bg-red-800 transition">Logout</button>
                </form>
            @else
                <!-- Register Button -->
                <a href="{{ route('register') }}" class="bg-green-700 text-black   px-4 py-2 rounded hover:bg-green-800 transition">Sign Up</a>
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="bg-blue-700 text-black px-4 py-2 rounded hover:bg-blue-800 transition">Login</a>
            @endauth
        </div>
    </div>
</nav>
