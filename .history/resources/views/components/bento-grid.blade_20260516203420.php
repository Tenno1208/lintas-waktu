@props(['memories'])

<section>
    <!-- Filter Bar (Aesthetic Only, untuk logic interaktif bisa pakai Livewire nanti) -->
    <div class="flex flex-wrap gap-2 mb-8 border-b border-zinc-950 pb-4 overflow-x-auto">
        <button class="px-4 py-1.5 rounded-full text-xs font-mono bg-zinc-100 text-zinc-900 font-medium whitespace-nowrap">All Stories</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-mono bg-zinc-950 text-zinc-400 border border-zinc-900 hover:border-zinc-700 transition-colors whitespace-nowrap">🗻 Adventure</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-mono bg-zinc-950 text-zinc-400 border border-zinc-900 hover:border-zinc-700 transition-colors whitespace-nowrap">🏫 School Days</button>
        <button class="px-4 py-1.5 rounded-full text-xs font-mono bg-zinc-950 text-zinc-400 border border-zinc-900 hover:border-zinc-700 transition-colors whitespace-nowrap">🎓 Graduation</button>
    </div>

    <!-- Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($memories as $memory)
            @php
                $isLarge = $loop->first || $loop->iteration == 4;
            @endphp
            
            <div class="group relative overflow-hidden rounded-2xl bg-[#09090b] border border-zinc-900 h-80 transition-all duration-500 hover:border-zinc-700 {{ $isLarge ? 'md:col-span-2' : 'col-span-1' }}">
                
                <!-- Image Handling -->
                @if(!empty($memory->photos) && isset($memory->photos[0]))
                    <img src="{{ asset('storage/' . $memory->photos[0]) }}" class="h-full w-full object-cover opacity-30 group-hover:scale-103 group-hover:opacity-60 transition-all duration-700">
                @else
                    <div class="h-full w-full bg-gradient-to-br from-zinc-900 to-zinc-950 flex items-center justify-center opacity-20">
                        <svg class="w-8 h-8 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                <!-- Information Card Container -->
                <div class="absolute inset-0 p-6 flex flex-col justify-between bg-gradient-to-t from-[#050505] via-[#050505]/40 to-transparent">
                    <div class="flex justify-between items-start">
                        <span class="text-[10px] font-mono text-zinc-400 bg-zinc-900/80 border border-zinc-800 px-2.5 py-1 rounded-md backdrop-blur-sm">
                            {{ $memory->event_date->format('d M Y') }}
                        </span>
                        
                        <!-- Dynamic Badge Category -->
                        @if($memory->category == 'adventure')
                            <span class="text-[9px] font-mono uppercase tracking-wider bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded border border-emerald-500/20">Adventure</span>
                        @elseif($memory->category == 'school')
                            <span class="text-[9px] font-mono uppercase tracking-wider bg-blue-500/10 text-blue-400 px-2 py-0.5 rounded border border-blue-500/20">School Days</span>
                        @elseif($memory->category == 'graduation')
                            <span class="text-[9px] font-mono uppercase tracking-wider bg-amber-500/10 text-amber-400 px-2 py-0.5 rounded border border-amber-500/20">Graduation</span>
                        @endif
                    </div>
                    
                    <div>
                        <p class="text-[10px] font-mono text-zinc-500 uppercase tracking-wider mb-0.5">
                            {{ $memory->location }} @if($memory->height_mdpl) — {{ $memory->height_mdpl }} MDPL @endif
                        </p>
                        <h3 class="text-xl font-bold text-zinc-100 group-hover:text-emerald-400 transition-colors tracking-tight">{{ $memory->title }}</h3>
                        <p class="text-xs text-zinc-400 font-light mt-1.5 line-clamp-1 group-hover:line-clamp-none transition-all duration-300 leading-relaxed">
                            {{ $memory->story }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-3 border border-dashed border-zinc-900 rounded-2xl p-16 text-center bg-[#09090b]/30">
                <p class="text-zinc-500 text-sm mb-1">Kapsul waktu masih kosong.</p>
                <p class="text-xs text-zinc-600 font-mono">Belum ada arsip memori lintas waktu yang disimpan.</p>
            </div>
        @endforelse
    </div>
</section>