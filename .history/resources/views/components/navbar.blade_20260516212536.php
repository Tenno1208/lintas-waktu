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
    <div class="flex items-center gap-4">
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-zinc-600 hover:text-red-400 font-mono text-[10px] tracking-wider uppercase transition-colors">
                LOGOUT
            </button>
        </form>
        @if(!Route::is('admin.create'))
            <a href="{{ route('admin.create') }}" class="bg-emerald-500 text-black font-mono tracking-wider font-bold px-3.5 py-1.5 rounded-xl text-[10px] hover:bg-emerald-400 transition-all shadow-[0_0_15px_rgba(16,185,129,0.15)]">
                + MEMORI
            </a>
        @endif
    </div>
@else
<a href="{{ route('timeline') }}" class="hover:text-zinc-100 transition-colors font-mono text-[10px] tracking-widest">LINI MASA</a>
    <a href="{{ route('admin.index') }}" class="group bg-zinc-950 border border-zinc-900 text-zinc-400 hover:text-zinc-200 px-3.5 py-1.5 rounded-xl text-[11px] font-mono tracking-wider hover:border-zinc-700 transition-all flex items-center gap-2">
        ADMIN PANEL
    </a>
@endif
        </div>
    </div>
</nav>