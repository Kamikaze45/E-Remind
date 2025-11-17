<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white shadow-lg rounded-xl flex overflow-hidden w-full max-w-4xl">
        <!-- Left: Sign Up Form -->
        <div class="w-full lg:w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-4">Daftar Akun</h2>

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="mt-1 w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Nama lengkap">
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="user@gmail.com">
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required
                            class="mt-1 w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="mt-1 w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <!-- Role selection: card toggle -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Role</label>

                    <!-- actual radio inputs (visually hidden but accessible) -->
                    <div class="flex gap-4">
                       <label class="flex-1 cursor-pointer">
        <input type="radio" name="role" value="user"
            class="peer sr-only" @if(old('role','user')=='user') checked @endif>

        <div
            class="role-card rounded-lg border p-4 flex items-start gap-3 transition-all shadow-sm
            border-gray-300 peer-checked:border-blue-600 peer-checked:bg-blue-50">

            <div class="flex-shrink-0 mt-1">
                <svg class="w-8 h-8 text-gray-600 peer-checked:text-blue-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>

            <div class="flex-1">
                <h3 class="text-sm font-semibold peer-checked:text-blue-700">Mahasiswa</h3>
            </div>
        </div>
    </label>

                        <label class="flex-1 cursor-pointer">
    <input type="radio" name="role" value="dosen"
        class="peer sr-only"
        @if(old('role')=='dosen') checked @endif>

    <div
        class="role-card rounded-lg border p-4 flex items-start gap-3 transition-all shadow-sm
        border-gray-300 peer-checked:border-blue-600 peer-checked:bg-blue-50">

        <div class="flex-shrink-0 mt-1">
            <svg class="w-8 h-8 text-gray-600 peer-checked:text-blue-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M12 14l6.16-3.422A12.042 12.042 0 0112 21.5 12.042 12.042 0 015.84 10.578L12 14z" />
            </svg>
        </div>

        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold peer-checked:text-blue-700">Dosen</h3>
            </div>
        </div>

    </div>
</label>

                    </div>

                    @error('role')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600 transition">Daftar</button>
            </form>

            <p class="mt-4 text-center text-gray-500">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a>
            </p>
        </div>

        <!-- Right: Visual / Info -->
        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-br from-blue-400 to-blue-500 text-white flex-col items-center justify-center p-8">
            <h2 class="text-2xl font-bold mb-3">Selamat Datang!</h2>
            <p class="mb-6 text-center">Pilih role yang sesuai. Role menentukan akses dan fitur yang bisa digunakan.</p>
            <a href="{{ route('login') }}"
                class="border border-white px-6 py-2 rounded hover:bg-white hover:text-blue-500 transition">Masuk</a>
        </div>
    </div>

    <!-- Small inline script to add selected class -->
    <script>
    // add selected styling to the checked radio
    function refreshRoleCards() {
        document.querySelectorAll('.role-card').forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            if (radio.checked) {
                card.classList.add('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
                card.classList.remove('opacity-80');
            } else {
                card.classList.remove('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
            }
        });
    }

    document.addEventListener('click', (e) => {
        // if a role card clicked, toggle the radio
        const card = e.target.closest('.role-card');
        if (card) {
            const radio = card.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
                refreshRoleCards();
            }
        }
    });

    // initial
    refreshRoleCards();
    </script>
</body>

</html>