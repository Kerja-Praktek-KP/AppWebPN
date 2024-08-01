<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadilan Negeri</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-[#22805E]">
    <div class="bg-white p-4 md:p-8 rounded-[5px] shadow-lg w-10/12 sm:w-4/5 md:w-3/5 lg:w-2/5 xl:w-1/3 2xl:w-1/4">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 mb-4">
            <h1 class="text-2xl font-bold mb-2">Selamat Datang</h1>
            <h2 class="text-xl font-bold">Masuk</h2>
        </div>
        <form method="POST" action="/login" class="space-y-4">
            @csrf
            <input type="text" name="nama" placeholder="Nama" required class="w-full p-3 border border-gray-300 rounded-[5px] focus:outline-none focus:ring-2 focus:ring-green-700">
            <div class="relative mb-4">
                <input type="password" id="password" placeholder="Kata Sandi" required class="w-full p-3 border border-gray-300 rounded-[5px] focus:outline-none focus:ring-2 focus:ring-green-700">
                <button type="button" id="togglePassword" class="absolute right-3 top-3 text-gray-600">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            <script>
                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');
                const eyeIcon = document.querySelector('#eyeIcon');
        
                togglePassword.addEventListener('click', function () {
                    // Toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
        
                    // Toggle the eye icon
                    if (type === 'text') {
                        eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>                     
                        `;
                    } else {
                        eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.542-7a10.018 10.018 0 013.275-5.018m3.788-1.422a10.05 10.05 0 014.69 0M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                        `;
                    }
                });
            </script>
            <button type="submit" class="w-full py-3 bg-[#22805E] text-white rounded-[5px] hover:bg-green-800">Masuk</button>
        </form>
    </div>
</body>
</html>
