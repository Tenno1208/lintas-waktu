<body class="bg-waktu-bg text-waktu-dark font-sans">
    <nav class="py-8 flex flex-col items-center">
        <!-- Logo Lintas Waktu -->
        <img src="{{ asset('img/logo-lintas-waktu.png') }}" alt="Logo" class="w-32 mb-4">
        <h1 class="font-serif text-3xl tracking-widest uppercase">Lintas Waktu</h1>
        <p class="text-xs italic opacity-70">Setiap Momen, Bagian Dari Cerita Kita</p>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        {{ $slot }}
    </main>
</body>