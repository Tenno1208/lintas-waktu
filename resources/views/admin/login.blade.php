<x-layout>
    <div class="min-h-screen flex flex-col justify-center items-center p-6 relative bg-[#030303]">
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:40px_40px]"></div>
        <div class="absolute w-[300px] h-[300px] bg-emerald-500/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="w-full max-w-md z-10 animate-fade-in">
            <div class="text-center mb-8 select-none">
                <div class="inline-block bg-white/[0.02] border border-white/10 p-3 rounded-2xl backdrop-blur-sm shadow-xl mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Lintas Waktu" class="w-12 h-12 object-contain rounded-xl">
                </div>
                <h1 class="text-xl font-bold font-mono tracking-[0.2em] uppercase text-zinc-100">
                    LINTAS<span class="text-emerald-500">.</span>WAKTU
                </h1>
                <p class="text-xs text-zinc-500 font-mono tracking-wider mt-1">Otentikasi Kunci Lini Masa</p>
            </div>

            <div class="bg-[#09090b] border border-zinc-900 p-6 md:p-8 rounded-2xl shadow-2xl">
                @if(session('error'))
                    <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-xl text-xs font-mono text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="/admin/login" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-1.5">Identitas / User</label>
                        <input type="text" name="username" required autocomplete="off" placeholder="Masukkan username" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-xs text-zinc-200 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-1.5">Kunci Sandi / Password</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-xs text-zinc-200 focus:outline-none transition-all">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-black font-mono font-bold py-3 rounded-xl transition-all uppercase text-xs tracking-widest shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                            DEKRIPSI AKSES
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-6 select-none">
                <a href="/" class="text-[10px] font-mono text-zinc-600 hover:text-zinc-400 tracking-wider uppercase transition-colors">← Kembali ke Laman Utama</a>
            </div>
        </div>
    </div>
</x-layout>