<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse($mountains as $mountain)
        @php
            // Logika agar item pertama atau kelipatan tertentu menjadi lebih besar (Bento Style)
            $isLarge = $loop->first || $loop->iteration == 4;
        @endphp
        
        <div class="group relative overflow-hidden rounded-2xl bg-zinc-950 border border-zinc-900 h-80 transition-all duration-500 hover:border-zinc-700 {{ $isLarge ? 'md:col-span-2' : 'col-span-1' }}">
            <!-- Foto Utama -->
            @if(!empty($mountain->photos) && isset($mountain->photos[0]))
                <img src="{{ asset('storage/' . $mountain->photos[0]) }}" class="h-full w-full object-cover opacity-40 group-hover:scale-105 group-hover:opacity-70 transition-all duration-700">
            @else
                <!-- Placeholder jika tidak ada gambar -->
                <div class="h-full w-full bg-gradient-to-br from-zinc-900 to-zinc-950 flex items-center justify-center">
                    <svg class="w-8 h-8 text-zinc-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif
            
            <!-- Overlay Info -->
            <div class="absolute inset-0 p-6 flex flex-col justify-between bg-gradient-to-t from-black/90 via-black/20 to-transparent">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-mono text-zinc-500 bg-black/40 px-2.5 py-1 rounded-md backdrop-blur-sm">
                        {{ $mountain->climb_date->format('d / m / Y') }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-mono text-emerald-500 uppercase tracking-wider mb-1">{{ $mountain->location }}</p>
                    <h3 class="text-xl font-bold text-zinc-100 group-hover:text-emerald-400 transition-colors">{{ $mountain->name }}</h3>
                    <p class="text-sm text-zinc-400 font-light mt-1 line-clamp-1 group-hover:line-clamp-none transition-all duration-300">
                        {{ $mountain->height }} MDPL — {{ Str::limit($mountain->description, 60) }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-1 md:col-span-3 border border-dashed border-zinc-800 rounded-2xl p-16 text-center bg-zinc-950/50">
            <p class="text-zinc-500 text-sm mb-1">Belum ada jejak pendakian.</p>
            <p class="text-xs text-zinc-600 font-mono">Arsip memori pendakian kamu akan muncul di sini.</p>
        </div>
    @endforelse
</div>