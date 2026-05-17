<div id="landing-gate" class="fixed inset-0 z-[100] flex flex-col justify-between bg-[#030303] p-6 md:p-12 transition-all duration-1000 ease-in-out select-none">
    
    <!-- Background Grid & Efek Glow Minimalis -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:40px_40px]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] md:w-[500px] h-[300px] md:h-[500px] bg-emerald-500/5 rounded-full blur-[120px] pointer-events-none"></div>
    
    <!-- Top Bar -->
    <div class="flex justify-between items-center z-10 border-b border-zinc-900/40 pb-4">
        <div class="flex items-center gap-3">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-ping"></span>
            <span class="font-mono text-[10px] md:text-xs tracking-widest text-zinc-500">SYSTEM: ONLINE</span>
        </div>
        <span class="font-mono text-[10px] md:text-xs tracking-[0.2em] text-zinc-500">TIME CAPSULE // 2026</span>
    </div>

    <!-- Main Content (Center) -->
    <div class="max-w-4xl mx-auto text-center my-auto z-10 flex flex-col items-center">
        
        <!-- Custom Abstract Logo SVG (Minimalist Peak & Timeline Layer) -->
        <div class="mb-8 relative group">
            <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-emerald-500/20 to-zinc-500/0 blur opacity-40 group-hover:opacity-100 transition duration-1000"></div>
            <div class="relative bg-zinc-950/40 border border-zinc-800/60 p-5 rounded-3xl backdrop-blur-sm">
                <svg class="w-12 h-12 text-zinc-200 transition-transform duration-700 group-hover:rotate-[360deg]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <!-- Layer Gunung / Milestone Atas -->
                    <path d="M12 2L2 18h20L12 2z" class="stroke-emerald-500" stroke-width="1.8"/>
                    <!-- Garis Lintas Waktu / Jalur Internal -->
                    <path d="M12 2v16" />
                    <path d="M7 14h10" />
                    <!-- Elemen Geometris Dasar -->
                    <path d="M3 21h18" class="stroke-zinc-700" />
                </svg>
            </div>
        </div>

        <!-- Subtitle / Meta Tag -->
        <p class="text-[10px] md:text-xs font-mono tracking-[0.4em] text-emerald-400 uppercase mb-4 pl-[0.4em]">
            // MEREKAM JEJAK & LINTAS WAKTU
        </p>
        
        <!-- Main Title -->
        <h1 class="text-5xl md:text-8xl font-black tracking-tighter text-zinc-100 uppercase bg-clip-text bg-gradient-to-b from-zinc-100 to-zinc-400">
            CHAPTERS<span class="text-emerald-500 font-light">.</span>
        </h1>
        
        <!-- Description -->
        <p class="text-zinc-500 text-xs md:text-sm max-w-sm md:max-w-md mx-auto mt-6 font-light leading-relaxed tracking-wide px-4">
            Arsip digital personal untuk mendokumentasikan dinginnya puncak gunung, hangatnya kisah sekolah, hingga selebrasi wisuda.
        </p>
        
        <!-- Action Button -->
        <button onclick="closeLandingGate()" class="group mt-12 inline-flex items-center gap-4 bg-zinc-950 border border-zinc-900 hover:border-emerald-500/50 text-zinc-300 hover:text-zinc-100 px-7 py-3.5 rounded-2xl text-xs font-mono tracking-[0.2em] transition-all duration-500 hover:shadow-[0_0_30px_rgba(16,185,129,0.08)]">
            BUKA JURNAL
            <div class="relative w-4 h-4 overflow-hidden">
                <svg class="w-4 h-4 text-zinc-500 group-hover:text-emerald-400 absolute transition-all duration-300 transform group-hover:translate-x-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
                <svg class="w-4 h-4 text-emerald-400 absolute transition-all duration-300 transform -translate-x-5 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </div>
        </button>
    </div>

    <!-- Bottom Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-3 z-10 border-t border-zinc-900/40 pt-4 font-mono text-[9px] md:text-[10px] text-zinc-600 w-full tracking-wider">
        <div class="flex items-center gap-2">
            <span class="text-zinc-700">INDEX //</span>
            <span>DIGITAL TIME CAPSULE</span>
        </div>
        <div class="tracking-widest opacity-80">©2026 ARCHIVE. ALL RIGHTS RESERVED</div>
    </div>
</div>

<script>
    function closeLandingGate() {
        const gate = document.getElementById('landing-gate');
        // Kombinasi transisi slide up + mengecil + fade out (Sangat smooth)
        gate.style.transform = 'translateY(-100%) scale(0.98)';
        gate.style.opacity = '0';
        
        setTimeout(() => {
            gate.remove();
        }, 1000);
    }
</script>