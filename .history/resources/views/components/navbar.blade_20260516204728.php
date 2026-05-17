<nav class="border-b border-zinc-900 bg-[#030303]/80 backdrop-blur-md sticky top-0 z-50 select-none">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="/" class="font-mono text-xs tracking-[0.2em] font-black text-zinc-200 hover:text-emerald-400 transition-colors">
            LINTAS<span class="text-emerald-500">.</span>WAKTU
        </a>
        
        <div class="flex items-center gap-4 md:gap-6">
            <div class="hidden md:flex items-center gap-2">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="font-mono text-[10px] text-zinc-600 tracking-wider">CORE: ACTIVE</span>
            </div>

            @if(Route::is('admin.*'))
                <a href="/" class="text-zinc-500 hover:text-zinc-300 font-mono text-[11px] tracking-wider transition-colors">
                    ← KELUAR
                </a>
                @if(!Route::is('admin.create'))
                    <a href="{{ route('admin.create') }}" class="bg-emerald-500 text-black font-mono tracking-wider font-bold px-3.5 py-1.5 rounded-xl text-[10px] hover:bg-emerald-400 transition-all shadow-[0_0_15px_rgba(16,185,129,0.15)]">
                        + MEMORI
                    </a>
                @endif
            @else
                <a href="{{ route('admin.index') }}" class="group bg-zinc-950 border border-zinc-900 text-zinc-400 hover:text-zinc-200 px-3.5 py-1.5 rounded-xl text-[11px] font-mono tracking-wider hover:border-zinc-700 transition-all flex items-center gap-2">
                    ADMIN PANEL
                    <svg class="w-3 h-3 text-zinc-600 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</nav>