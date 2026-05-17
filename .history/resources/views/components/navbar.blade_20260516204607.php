<nav class="border-b border-zinc-950 bg-[#050505]/80 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="/" class="font-mono text-sm tracking-widest font-bold text-zinc-200">
            LINTAS<span class="text-emerald-500">.</span>WAKTU
        </a>
        <a href="{{ route('admin.index') }}" class="bg-zinc-900 border border-zinc-800 text-zinc-200 px-3 py-1.5 rounded-lg text-xs hover:border-zinc-700 transition-all">
    Admin Panel
    </a>
        <div class="flex items-center gap-6 text-sm text-zinc-400">
            <span class="hidden md:inline font-mono text-xs text-zinc-600">STATUS: ACTIVE</span>
            <a href="#" class="bg-zinc-900 border border-zinc-800 text-zinc-200 px-3 py-1.5 rounded-lg text-xs hover:border-zinc-700 transition-all">
                + Tambah Memori
            </a>
        </div>
    </div>
</nav>