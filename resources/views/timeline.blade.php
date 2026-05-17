<x-layout>
    <div x-data="{ 
        open: false, 
        selected: null, 
        currentPhotoIndex: 0,
        memories: {{ json_encode($memories) }},
        nextPhoto() { if (this.currentPhotoIndex < this.selected.photos.length - 1) this.currentPhotoIndex++; else this.currentPhotoIndex = 0; },
        prevPhoto() { if (this.currentPhotoIndex > 0) this.currentPhotoIndex--; else this.currentPhotoIndex = this.selected.photos.length - 1; }
    }" class="min-h-screen bg-[#030303] text-zinc-100 flex flex-col justify-between overflow-x-hidden">
        
        <header class="p-6 md:p-10 flex justify-between items-center z-20 shrink-0">
            <a href="/" class="font-mono text-xs tracking-[0.3em] font-black text-zinc-100 uppercase">
                LINTAS<span class="text-emerald-500">.</span>WAKTU
            </a>
            <div class="flex items-center gap-4">
                <span class="font-mono text-[9px] text-zinc-600 tracking-widest hidden sm:block uppercase">Mode: Linear Timeline</span>
                <a href="/" class="text-zinc-400 hover:text-white text-[10px] font-mono border border-zinc-900 bg-zinc-950 px-4 py-2 rounded-xl transition-all tracking-wider">KEMBALI</a>
            </div>
        </header>

        <main class="flex-1 w-full flex flex-col md:flex-row items-center relative overflow-y-auto md:overflow-y-hidden md:overflow-x-auto custom-scrollbar-h py-12 md:py-0">
            
            <div class="absolute w-[2px] bg-gradient-to-b from-transparent via-zinc-800 to-transparent h-full left-1/2 -translate-x-1/2 md:hidden top-0"></div>
            <div class="absolute h-[1px] bg-gradient-to-r from-transparent via-zinc-800 to-transparent w-full top-1/2 -translate-y-1/2 hidden md:block left-0"></div>

            <div class="flex flex-col md:flex-row px-6 md:px-[20vw] gap-16 md:gap-44 items-center relative w-full md:w-auto">
                
                @forelse($memories as $index => $memory)
                    <div class="relative flex flex-col md:flex-row items-center justify-center w-full md:w-auto flex-shrink-0">
                        
                        <div class="w-3 h-3 rounded-full bg-zinc-950 border-2 border-emerald-500 z-10 shadow-[0_0_15px_rgba(16,185,129,0.6)] my-4 md:my-0"></div>

                        <div 
                            class="absolute w-[calc(50vw-2rem)] sm:w-72 md:w-80 group cursor-pointer z-20
                                   {{ $index % 2 == 0 ? 'left-0 pr-4 md:left-auto md:pr-0 md:bottom-12' : 'right-0 pl-4 md:right-auto md:pl-0 md:top-12' }}" 
                            @click="selected = memories[{{ $index }}]; currentPhotoIndex = 0; open = true"
                        >
                            <span class="font-mono text-[9px] text-emerald-500 tracking-widest block mb-1.5 uppercase {{ $index % 2 == 0 ? 'text-right md:text-left' : 'text-left' }}">
                                {{ $memory->event_date->format('d M Y') }}
                            </span>
                            
                            <div class="bg-zinc-950 border border-zinc-900 p-3 md:p-4 rounded-2xl group-hover:border-emerald-500/30 transition-all duration-500 hover:shadow-[0_0_30px_rgba(16,185,129,0.02)]">
                                <div class="aspect-video md:h-40 overflow-hidden rounded-xl mb-3 bg-zinc-900">
                                    @if(!empty($memory->photos))
                                        <img src="{{ asset('storage/' . $memory->photos[0]) }}" class="w-full h-full object-cover opacity-50 group-hover:opacity-90 group-hover:scale-103 transition-all duration-700">
                                    @endif
                                </div>
                                <h3 class="text-xs md:text-sm font-black text-zinc-100 tracking-tighter uppercase line-clamp-1 group-hover:text-emerald-400 transition-colors">{{ $memory->title }}</h3>
                                <div class="flex justify-between items-center mt-1.5 font-mono text-[9px] text-zinc-600 tracking-wider">
                                    <span class="uppercase truncate max-w-[70%]">{{ $memory->location }}</span>
                                    <span class="text-zinc-700 font-bold">{{ $memory->event_date->format('Y') }}</span>
                                </div>
                            </div>

                            <div class="absolute left-1/2 -translate-x-1/2 {{ $index % 2 == 0 ? 'top-full h-12' : 'bottom-full h-12' }} w-[1px] bg-zinc-900 hidden md:block pointer-events-none"></div>
                        </div>

                    </div>
                @empty
                    <div class="w-full text-center font-mono text-zinc-600 uppercase tracking-widest py-20">
                        [ PANGKALAN DATA REKAMAN KOSONG ]
                    </div>
                @endforelse

            </div>
        </main>

        <footer class="p-6 md:p-10 flex flex-col sm:flex-row justify-between items-center gap-2 font-mono text-[9px] text-zinc-700 uppercase tracking-[0.2em] select-none shrink-0 border-t border-zinc-950">
            <div class="hidden md:block">Tips: Gunakan Shift + Scroll untuk menggeser lini masa</div>
            <div class="md:hidden">Tips: Scroll ke bawah untuk melihat linimasa</div>
            <div>Chapters Digital Archive // ©2026</div>
        </footer>

        <template x-teleport="body">
            @include('components.modal-detail')
        </template>
    </div>

    <style>
        .custom-scrollbar-h::-webkit-scrollbar { height: 3px; width: 3px; }
        .custom-scrollbar-h::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar-h::-webkit-scrollbar-thumb { background: #111; border-radius: 10px; }
        .custom-scrollbar-h::-webkit-scrollbar-thumb:hover { background: #10b981; }
    </style>
</x-layout>