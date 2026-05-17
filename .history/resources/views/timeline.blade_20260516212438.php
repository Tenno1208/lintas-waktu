<x-layout>
    <div x-data="{ 
        open: false, 
        selected: null, 
        currentPhotoIndex: 0,
        memories: {{ json_encode($memories) }},
        nextPhoto() { if (this.currentPhotoIndex < this.selected.photos.length - 1) this.currentPhotoIndex++; else this.currentPhotoIndex = 0; },
        prevPhoto() { if (this.currentPhotoIndex > 0) this.currentPhotoIndex--; else this.currentPhotoIndex = this.selected.photos.length - 1; }
    }" class="h-screen w-screen bg-[#030303] overflow-hidden flex flex-col">
        
        <header class="p-6 md:p-10 flex justify-between items-center z-20">
            <a href="/" class="font-mono text-xs tracking-[0.3em] font-black text-zinc-100 uppercase">
                LINTAS<span class="text-emerald-500">.</span>WAKTU
            </a>
            <div class="flex items-center gap-6">
                <span class="font-mono text-[10px] text-zinc-600 tracking-widest hidden md:block uppercase">Mode: Linear Timeline</span>
                <a href="/" class="text-zinc-400 hover:text-white text-[10px] font-mono border border-zinc-900 px-4 py-2 rounded-full transition-all">KEMBALI</a>
            </div>
        </header>

        <main class="flex-1 overflow-x-auto overflow-y-hidden flex items-center custom-scrollbar-h select-none relative">
            
            <div class="absolute h-[1px] bg-gradient-to-r from-transparent via-zinc-800 to-transparent w-full top-1/2 -translate-y-1/2"></div>

            <div class="flex px-[10vw] md:px-[20vw] gap-20 md:gap-40 items-center">
                
                @forelse($memories as $index => $memory)
                    <div class="relative flex-shrink-0 flex flex-col items-center">
                        
                        <div class="w-3 h-3 rounded-full bg-zinc-900 border-2 border-emerald-500 z-10 shadow-[0_0_15px_rgba(16,185,129,0.5)]"></div>

                        <div class="absolute {{ $index % 2 == 0 ? 'bottom-10' : 'top-10' }} w-64 md:w-80 group cursor-pointer" 
                             @click="selected = memories[{{ $index }}]; currentPhotoIndex = 0; open = true">
                            
                            <span class="font-mono text-[9px] text-emerald-500 tracking-widest block mb-2 uppercase">{{ $memory->event_date->format('d M Y') }}</span>
                            
                            <div class="bg-zinc-950 border border-zinc-900 p-4 rounded-2xl group-hover:border-emerald-500/30 transition-all duration-500 hover:shadow-2xl">
                                <div class="h-32 md:h-40 overflow-hidden rounded-xl mb-4 bg-zinc-900">
                                    @if(!empty($memory->photos))
                                        <img src="{{ asset('storage/' . $memory->photos[0]) }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                                    @endif
                                </div>
                                <h3 class="text-sm font-black text-zinc-100 tracking-tighter uppercase line-clamp-1 group-hover:text-emerald-400 transition-colors">{{ $memory->title }}</h3>
                                <p class="text-[10px] text-zinc-600 mt-1 uppercase font-mono tracking-widest">{{ $memory->location }}</p>
                            </div>

                            <div class="absolute left-1/2 -translate-x-1/2 {{ $index % 2 == 0 ? 'top-full h-10' : 'bottom-full h-10' }} w-[1px] bg-zinc-800"></div>
                        </div>

                        <div class="absolute -bottom-10 font-mono text-[10px] text-zinc-700 font-bold tracking-widest">
                            {{ $memory->event_date->format('Y') }}
                        </div>
                    </div>
                @empty
                    <div class="text-center font-mono text-zinc-600 uppercase tracking-widest">
                        Pangkalan Data Belum Diisi...
                    </div>
                @endforelse

            </div>
        </main>

        <footer class="p-10 flex justify-between items-center font-mono text-[9px] text-zinc-700 uppercase tracking-[0.3em] select-none">
            <div>Shift + Scroll untuk geser lini masa</div>
            <div>Chapters Digital Archive // v1.0</div>
        </footer>

        <template x-teleport="body">
            @include('components.modal-detail') {{-- Kita akan buat file include ini agar lebih rapi --}}
        </template>
    </div>

    <style>
        .custom-scrollbar-h::-webkit-scrollbar { height: 2px; }
        .custom-scrollbar-h::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar-h::-webkit-scrollbar-thumb { background: #111; border-radius: 10px; }
        .custom-scrollbar-h::-webkit-scrollbar-thumb:hover { background: #10b981; }
    </style>
</x-layout>