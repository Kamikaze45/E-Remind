<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-xl flex overflow-hidden w-full max-w-4xl">
        <!-- Left: Login Form -->
        <div class="w-1/2 p-10">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Sign In</h2>

            {{-- Pesan Error / Sukses --}}
            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input type="email" name="email" placeholder="Email"
                        class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        value="{{ old('email') }}" required>
                </div>

                <div>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <div class="flex justify-end">
                    <a href="#" class="text-sm text-blue-500 hover:underline cursor-pointer">
                        Lupa kata sandi?
                    </a>
                </div>

                <button type="submit"
                    class="w-full bg-blue-400 text-white font-bold py-2 rounded hover:bg-blue-500 transition">
                    SIGN IN
                </button>
            </form>
        </div>

        <!-- Right: Sign Up Prompt -->
        <div
            class="w-1/2 bg-gradient-to-br from-blue-400 to-blue-500 text-white flex flex-col items-center justify-center p-10">
            <h2 class="text-3xl font-bold mb-4">Halo, Teman!</h2>
            <p class="mb-6 text-center">Daftarkan diri anda dan mulai gunakan layanan kami segera.</p>
            <a href="{{ route('register') }}"
                class="border border-white px-6 py-2 rounded hover:bg-white hover:text-blue-500 transition">
                SIGN UP
            </a>
        </div>
    </div>
</body>

</html>