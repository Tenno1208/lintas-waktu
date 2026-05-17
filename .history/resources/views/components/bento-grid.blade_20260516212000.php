@props(['memories'])

<section x-data="{ 
    open: false, 
    selected: null,
    activeFilter: 'all',
    currentPhotoIndex: 0, // State untuk memantau foto ke-berapa yang lagi dibuka di modal
    memories: {{ json_encode($memories) }},
    hasVisibleItems() {
        if (this.activeFilter === 'all') return this.memories.length > 0;
        return this.memories.some(m => m.category === this.activeFilter);
    },
    nextPhoto() {
        if (this.currentPhotoIndex < this.selected.photos.length - 1) {
            this.currentPhotoIndex++;
        } else {
            this.currentPhotoIndex = 0; // Loop kembali ke foto pertama
        }
    },
    prevPhoto() {
        if (this.currentPhotoIndex > 0) {
            this.currentPhotoIndex--;
        } else {
            this.currentPhotoIndex = this.selected.photos.length - 1; // Loop ke foto terakhir
        }
    }
}">
    <div class="flex flex-wrap gap-2 mb-8 border-b border-zinc-950 pb-4 overflow-x-auto select-none">
        <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-zinc-100 text-zinc-900 font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">All Stories</button>
        <button @click="activeFilter = 'adventure'" :class="activeFilter === 'adventure' ? 'bg-emerald-500 text-black font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">🗻 Adventure</button>
        <button @click="activeFilter = 'school'" :class="activeFilter === 'school' ? 'bg-blue-500 text-white font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">🏫 School Days</button>
        <button @click="activeFilter = 'graduation'" :class="activeFilter === 'graduation' ? 'bg-amber-500 text-black font-bold' : 'bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700'" class="px-4 py-1.5 rounded-full text-[10px] font-mono uppercase transition-colors duration-300">🎓 Graduation</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach($memories as $index => $memory)
            @php $isLarge = $loop->first || $loop->iteration == 4; @endphp
            
            <div 
                x-show="activeFilter === 'all' || activeFilter === '{{ $memory->category }}'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                @click="selected = memories[{{ $index }}]; currentPhotoIndex = 0; open = true"
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
        <div 
            x-show="open" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[200] flex items-center justify-center p-0 md:p-6 bg-black/98 backdrop-blur-2xl"
            @keydown.escape.window="open = false"
            @keydown.right.window="if(selected && selected.photos.length > 1) nextPhoto()"
            @keydown.left.window="if(selected && selected.photos.length > 1) prevPhoto()"
            style="display: none;"
        >
            <div @click.away="open = false" class="bg-[#050505] md:border md:border-zinc-900 w-full max-w-7xl h-full md:h-[90vh] overflow-hidden md:rounded-[2.5rem] flex flex-col md:flex-row shadow-2xl">
                
                <div class="w-full md:w-8/12 h-[50vh] md:h-full bg-[#020202] relative flex flex-col justify-between p-4 border-b md:border-b-0 md:border-r border-zinc-900 select-none">
                    
                    <div class="w-full flex-1 flex items-center justify-center relative overflow-hidden">
                        <template x-if="selected">
                            <img 
                                :src="'/storage/' + selected.photos[currentPhotoIndex]" 
                                class="max-w-full max-h-[40vh] md:max-h-[70vh] w-auto h-auto object-contain rounded-xl shadow-2xl transition-all duration-300"
                            >
                        </template>

                        <template x-if="selected && selected.photos.length > 1">
                            <div>
                                <button @click="prevPhoto()" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white p-2.5 rounded-xl transition-all backdrop-blur-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button @click="nextPhoto()" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white p-2.5 rounded-xl transition-all backdrop-blur-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <template x-if="selected && selected.photos.length > 1">
                        <div class="w-full flex justify-center gap-2 overflow-x-auto py-2 custom-scrollbar max-h-16">
                            <template x-for="(photo, index) in selected.photos" :key="index">
                                <button 
                                    @click="currentPhotoIndex = index"
                                    class="h-10 w-14 rounded-md overflow-hidden border flex-shrink-0 transition-all duration-300"
                                    :class="currentPhotoIndex === index ? 'border-emerald-500 scale-105 shadow-md shadow-emerald-500/10' : 'border-zinc-800 opacity-40 hover:opacity-100'"
                                >
                                    <img :src="'/storage/' + photo" class="w-full h-full object-cover">
                                </button>
                            </template>
                        </div>
                    </template>
                </div>

                <div class="w-full md:w-4/12 p-6 md:p-10 overflow-y-auto flex flex-col justify-between h-[50vh] md:h-full bg-[#050505]">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <span class="text-[9px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full uppercase tracking-[0.2em]" x-text="selected?.category"></span>
                            <button @click="open = false" class="text-zinc-500 hover:text-zinc-200 border border-zinc-900 p-1.5 rounded-lg transition-colors bg-zinc-950/40">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <h2 class="text-2xl md:text-4xl font-black text-zinc-100 uppercase tracking-tighter leading-tight mb-4" x-text="selected?.title"></h2>
                        
                        <div class="flex flex-wrap gap-x-4 gap-y-2 mb-6 border-y border-zinc-900 py-3 font-mono text-[9px] text-zinc-500 uppercase tracking-widest">
                            <div class="flex flex-col">
                                <span class="text-zinc-700">Tanggal</span>
                                <span class="text-zinc-300 mt-0.5" x-text="new Date(selected?.event_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})"></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-zinc-700">Lokasi</span>
                                <span class="text-zinc-300 mt-0.5" x-text="selected?.location || 'Tidak Ada Data'"></span>
                            </div>
                            <template x-if="selected?.height_mdpl">
                                <div class="flex flex-col">
                                    <span class="text-zinc-700">Elevasi</span>
                                    <span class="text-emerald-400 font-bold mt-0.5" x-text="selected?.height_mdpl + ' MDPL'"></span>
                                </div>
                            </template>
                        </div>

                        <p class="text-zinc-400 text-xs md:text-sm leading-relaxed font-light whitespace-pre-line custom-scrollbar" x-text="selected?.story"></p>
                    </div>

                    <div class="mt-8 pt-4 border-t border-zinc-900/60 flex justify-between items-center text-[9px] font-mono text-zinc-700 uppercase tracking-widest select-none">
                        <div>LINTAS WAKTU ARCHIVE</div>
                        <template x-if="selected && selected.photos.length > 1">
                            <div class="text-zinc-500 font-bold bg-zinc-900/60 border border-zinc-800/60 px-2 py-0.5 rounded-md" x-text="(currentPhotoIndex + 1) + ' / ' + selected.photos.length"></div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>
</section>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; height: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1f1f23; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #2e2e33; }
</style>