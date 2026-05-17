@props(['memories'])

<section x-data="{ 
    open: false, 
    selected: null,
    activeFilter: 'all',
    currentPhotoIndex: 0,
    memories: {{ json_encode($memories) }},
    
    hasVisibleItems() {
        if (this.activeFilter === 'all') return this.memories.length > 0;
        return this.memories.some(m => m.category === this.activeFilter);
    },
    nextPhoto() {
        if (this.currentPhotoIndex < this.selected.photos.length - 1) this.currentPhotoIndex++;
        else this.currentPhotoIndex = 0;
    },
    prevPhoto() {
        if (this.currentPhotoIndex > 0) this.currentPhotoIndex--;
        else this.currentPhotoIndex = this.selected.photos.length - 1;
    },
    
    // INOVASI 5: Gali Kapsul Acak
    openRandomCapsule() {
        if (this.memories.length === 0) return;
        const randomIndex = Math.floor(Math.random() * this.memories.length);
        this.selected = this.memories[randomIndex];
        this.currentPhotoIndex = 0;
        this.open = true;
        
        if (this.selected.category === 'graduation') {
            setTimeout(() => { this.triggerGraduationConfetti(); }, 300);
        }
    },

    // INOVASI 3: Efek Selebrasi Lempar Topi Wisuda via Confetti
    triggerGraduationConfetti() {
        var duration = 3 * 1000;
        var end = Date.now() + duration;

        (function frame() {
            confetti({ particleCount: 3, angle: 60, spread: 55, origin: { x: 0, y: 0.8 }, colors: ['#10b981', '#ffffff', '#3b82f6'] });
            confetti({ particleCount: 3, angle: 120, spread: 55, origin: { x: 1, y: 0.8 }, colors: ['#10b981', '#ffffff', '#fbbf24'] });
            if (Date.now() < end) { requestAnimationFrame(frame); }
        }());
    }
}">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 border-b border-zinc-950 pb-4">
        <div class="flex flex-wrap gap-2 overflow-x-auto select-none w-full md:w-auto">
            <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-zinc-100 text-zinc-900 font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">All Stories</button>
            <button @click="activeFilter = 'adventure'" :class="activeFilter === 'adventure' ? 'bg-emerald-500 text-black font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">🗻 Adventure</button>
            <button @click="activeFilter = 'school'" :class="activeFilter === 'school' ? 'bg-blue-500 text-white font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">🏫 School Days</button>
            <button @click="activeFilter = 'graduation'" :class="activeFilter === 'graduation' ? 'bg-amber-500 text-black font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">🎓 Graduation</button>
        </div>

        <button @click="openRandomCapsule()" class="w-full md:w-auto bg-zinc-950 border border-zinc-900 hover:border-emerald-500/40 text-zinc-400 hover:text-emerald-400 px-4 py-2 rounded-xl text-[10px] font-mono tracking-widest transition-all duration-300 flex items-center justify-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            GALI KAPSUL ACAK
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach($memories as $index => $memory)
            @php $isLarge = $loop->first || $loop->iteration == 4; @endphp
            
            <div 
                x-show="activeFilter === 'all' || activeFilter === '{{ $memory->category }}'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                @click="selected = memories[{{ $index }}]; currentPhotoIndex = 0; open = true; if(selected.category === 'graduation') triggerGraduationConfetti()"
                class="group relative overflow-hidden rounded-3xl bg-[#09090b] border border-zinc-900 h-[22rem] cursor-pointer transition-all duration-500 hover:border-emerald-500/30 {{ $isLarge ? 'md:col-span-2' : 'col-span-1' }}"
            >
                @if(!empty($memory->photos))
                    <img src="{{ asset('storage/' . $memory->photos[0]) }}" class="h-full w-full object-cover opacity-50 group-hover:scale-105 group-hover:opacity-80 transition-all duration-700">
                @endif
                
                <div class="absolute inset-0 p-8 flex flex-col justify-between bg-gradient-to-t from-black via-black/20 to-transparent">
                    <div class="flex justify-between items-start">
                        <span class="text-[9px] font-mono px-2.5 py-1 rounded-lg backdrop-blur-md uppercase tracking-widest border
                            {{ $memory->category === 'adventure' ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : '' }}
                            {{ $memory->category === 'school' ? 'text-blue-400 bg-blue-500/10 border-blue-500/20' : '' }}
                            {{ $memory->category === 'graduation' ? 'text-amber-400 bg-amber-500/10 border-amber-500/20' : '' }}
                        ">
                            {{ $memory->category }}
                        </span>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-mono text-zinc-500 uppercase tracking-tighter">{{ $memory->event_date->format('M Y') }} — {{ $memory->location }}</p>
                        <h3 class="text-2xl font-black text-zinc-100 tracking-tighter uppercase mt-1 group-hover:text-emerald-400 transition-colors">{{ $memory->title }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="!hasVisibleItems()" class="col-span-full py-24 text-center border border-dashed border-zinc-900 rounded-[2rem] bg-[#070709]/40 select-none" style="display: none;">
        <div class="max-w-xs mx-auto space-y-3">
            <div class="inline-flex p-3 bg-zinc-950 border border-zinc-900 rounded-2xl text-zinc-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-zinc-400 font-mono text-xs uppercase tracking-widest">Arsip Belum Tersedia</p>
                <p class="text-zinc-600 text-xs font-light mt-1" x-text="
                    activeFilter === 'adventure' ? 'Belum ada jejak pendakian gunung yang dikunci ke dalam lini masa ini.' :
                    activeFilter === 'school' ? 'Masa-masa sekolah kamu belum diarsipkan di dalam sistem database.' :
                    activeFilter === 'graduation' ? 'Dokumentasi momen wisuda dan kelulusan belum diintegrasikan.' : 
                    'Pangkalan data utama kamu masih kosong melompong.'
                "></p>
            </div>
        </div>
    </div>

    <template x-teleport="body">
        @include('components.modal-detail')
    </template>
</section>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; height: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1f1f23; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #2e2e33; }
</style>