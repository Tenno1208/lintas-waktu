@props(['memories'])

<section x-data="{ 
    open: false, 
    selected: null,
    memories: {{ json_encode($memories) }}
}">
    <div class="flex flex-wrap gap-2 mb-8 border-b border-zinc-950 pb-4 overflow-x-auto select-none">
        <button class="px-4 py-1.5 rounded-full text-[10px] font-mono bg-zinc-100 text-zinc-900 font-bold uppercase">All Stories</button>
        <button class="px-4 py-1.5 rounded-full text-[10px] font-mono bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700 transition-colors uppercase">🗻 Adventure</button>
        <button class="px-4 py-1.5 rounded-full text-[10px] font-mono bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700 transition-colors uppercase">🏫 School Days</button>
        <button class="px-4 py-1.5 rounded-full text-[10px] font-mono bg-zinc-950 text-zinc-500 border border-zinc-900 hover:border-zinc-700 transition-colors uppercase">🎓 Graduation</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @forelse($memories as $index => $memory)
            @php $isLarge = $loop->first || $loop->iteration == 4; @endphp
            
            <div 
                @click="selected = memories[{{ $index }}]; open = true"
                class="group relative overflow-hidden rounded-3xl bg-[#09090b] border border-zinc-900 h-[22rem] cursor-pointer transition-all duration-500 hover:border-emerald-500/30 {{ $isLarge ? 'md:col-span-2' : 'col-span-1' }}"
            >
                @if(!empty($memory->photos))
                    <img src="{{ asset('storage/' . $memory->photos[0]) }}" class="h-full w-full object-cover opacity-50 group-hover:scale-105 group-hover:opacity-80 transition-all duration-700">
                @endif
                
                <div class="absolute inset-0 p-8 flex flex-col justify-between bg-gradient-to-t from-black via-black/20 to-transparent">
                    <div class="flex justify-between items-start">
                        <span class="text-[9px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-lg backdrop-blur-md uppercase tracking-widest">
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
        @empty
            <div class="col-span-full py-20 text-center border border-dashed border-zinc-900 rounded-3xl">
                <p class="text-zinc-600 font-mono text-xs uppercase tracking-widest">[ Belum Ada Jejak Terdeteksi ]</p>
            </div>
        @endforelse
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
            class="fixed inset-0 z-[200] flex items-center justify-center p-4 md:p-8 bg-black/95 backdrop-blur-xl"
            @keydown.escape.window="open = false"
            style="display: none;"
        >
            <div 
                @click.away="open = false"
                class="bg-[#080808] border border-zinc-900 w-full max-w-6xl max-h-full overflow-hidden rounded-[2rem] flex flex-col md:flex-row shadow-2xl"
            >
                <div class="w-full md:w-3/5 h-64 md:h-[80vh] bg-zinc-950 overflow-y-auto custom-scrollbar p-2 grid grid-cols-1 gap-2">
                    <template x-if="selected">
                        <template x-for="(photo, index) in selected.photos" :key="index">
                            <img :src="'/storage/' + photo" class="w-full h-auto rounded-2xl object-cover border border-zinc-900">
                        </template>
                    </template>
                </div>

                <div class="w-full md:w-2/5 p-8 md:p-12 overflow-y-auto flex flex-col justify-between border-t md:border-t-0 md:border-l border-zinc-900">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <span class="text-[10px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full uppercase tracking-[0.2em]" x-text="selected?.category"></span>
                            <button @click="open = false" class="text-zinc-500 hover:text-zinc-200 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <h2 class="text-3xl md:text-5xl font-black text-zinc-100 uppercase tracking-tighter leading-none mb-4" x-text="selected?.title"></h2>
                        
                        <div class="flex flex-wrap gap-x-6 gap-y-2 mb-8 border-y border-zinc-900 py-4 font-mono text-[10px] text-zinc-500 uppercase tracking-widest">
                            <div class="flex flex-col">
                                <span class="text-zinc-700">Tanggal</span>
                                <span class="text-zinc-300" x-text="new Date(selected?.event_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})"></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-zinc-700">Lokasi</span>
                                <span class="text-zinc-300" x-text="selected?.location || 'Tidak Ada Data'"></span>
                            </div>
                            <template x-if="selected?.height_mdpl">
                                <div class="flex flex-col">
                                    <span class="text-zinc-700">Elevasi</span>
                                    <span class="text-emerald-500 font-bold" x-text="selected?.height_mdpl + ' MDPL'"></span>
                                </div>
                            </template>
                        </div>

                        <p class="text-zinc-400 text-sm md:text-base leading-relaxed font-light whitespace-pre-line" x-text="selected?.story"></p>
                    </div>

                    <div class="mt-12 pt-6 border-t border-zinc-900">
                        <p class="text-[10px] font-mono text-zinc-700 uppercase tracking-widest">Digital Archive // Lintas Waktu</p>
                    </div>
                </div>
            </div>
        </div>
    </template>
</section>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #18181b; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #27272a; }
</style>