<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bank Sampah Digital</title>
    
    <!-- Using Tailwind via CDN just in case build fails -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased selection:bg-green-500 selection:text-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    <span class="text-xl font-bold text-gray-900">Bank Sampah</span>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-green-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-green-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500 transition">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md transition focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl w-full space-y-8 text-center">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">Ubah Sampah Jadi <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-emerald-700">Berkah</span></h1>
                    <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                        Program Bank Sampah Digital Desa mempermudah Anda mendaur ulang dan mendapatkan poin dari setiap setoran sampah. 
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="p-8 sm:p-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Bagaimana Cara Kerjanya?</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <h3 class="font-semibold text-lg">1. Daftar</h3>
                                <p class="text-gray-500 text-sm mt-2 text-center">Daftar akun secara mandiri (Register) dan dapatkan QR Code unik Anda di dalam Dashboard.</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h3 class="font-semibold text-lg">2. Setor</h3>
                                <p class="text-gray-500 text-sm mt-2 text-center">Bawa sampah daur ulang Anda ke Bank Sampah. Petugas akan menimbang dan scan QR Anda.</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="font-semibold text-lg">3. Panen Poin</h3>
                                <p class="text-gray-500 text-sm mt-2 text-center">Poin akan otomatis terkumpul dan dapat ditukarkan dengan kebutuhan sehari-hari.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-gray-500 text-sm mt-8">
                    Silakan Register jika Anda belum memiliki akun, atau Log In jika sudah terdaftar.
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Bank Sampah Digital Desa. Hak cipta dilindungi.
            </div>
        </footer>
    </div>
</body>
</html>
