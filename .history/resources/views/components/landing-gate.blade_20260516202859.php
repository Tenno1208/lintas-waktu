<div id="landing-gate" class="fixed inset-0 z-[100] flex flex-col justify-between bg-[#050505] p-8 md:p-16 transition-all duration-1000 ease-in-out">
    <!-- Dekorasi Garis Topografi / Koordinat (Aesthetic) -->
    <div class="absolute inset-0 opacity-5 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <!-- Top Bar -->
    <div class="flex justify-between items-center z-10">
        <span class="font-mono text-xs tracking-widest text-zinc-600">PROJECT: SUMMIT.STRIDE</span>
        <span class="font-mono text-xs text-zinc-600">SMRG, ID</span>
    </div>

    <!-- Main Content (Center) -->
    <div class="max-w-4xl mx-auto text-center my-auto z-10">
        <p class="text-xs font-mono tracking-[0.3em] text-emerald-500 uppercase mb-4 animate-pulse">
            // Memori Elevasi & Jejak Langkah
        </p>
        <h1 class="text-5xl md:text-8xl font-black tracking-tighter text-zinc-100 uppercase select-none">
            SUMMIT STRIDE<span class="text-emerald-500">.</span>
        </h1>
        <p class="text-zinc-500 text-sm md:text-base max-w-md mx-auto mt-6 font-light leading-relaxed">
            Merekam perjalanan, mengabadikan setiap puncak, dan merawat ingatan di saat ingatan itu sendiri mulai memudar.
        </p>
        
        <!-- Tombol Masuk Jurnal -->
        <button onclick="closeLandingGate()" class="group mt-10 inline-flex items-center gap-3 bg-zinc-900 border border-zinc-800 hover:border-emerald-500 text-zinc-200 px-6 py-3 rounded-full text-sm font-mono tracking-wider transition-all duration-300 hover:shadow-[0_0_20px_rgba(16,185,129,0.1)]">
            MASUK JURNAL
            <svg class="w-4 h-4 text-zinc-500 group-hover:text-emerald-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </button>
    </div>

    <!-- Bottom Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-2 z-10 border-t border-zinc-900/50 pt-4 font-mono text-[10px] text-zinc-600">
        <div>TERINSPIRASI OLEH ATAP-ATAP INDONESIA</div>
        <div class="tracking-widest">©2026 ARCHIVE ALL RIGHTS RESERVED</div>
    </div>
</div>

<!-- Script Efek Transisi Mulus -->
<script>
    function closeLandingGate() {
        const gate = document.getElementById('landing-gate');
        // Efek slide ke atas dan menghilang
        gate.style.transform = 'translateY(-100%)';
        gate.style.opacity = '0';
        
        // Hapus element dari DOM setelah animasi selesai agar tidak mengganggu klik di dashboard
        setTimeout(() => {
            gate.remove();
        }, 1000);
    }
</script>