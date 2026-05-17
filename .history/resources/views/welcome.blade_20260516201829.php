<x-layout>
    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Header & Stats -->
        <header class="mb-12 flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-bold tracking-tighter">SUMMIT MEMORIES.</h1>
                <p class="text-zinc-500">Arsip pendakian dan jejak langkah.</p>
            </div>
            <div class="text-right">
                <span class="text-5xl font-black text-zinc-800 uppercase tracking-widest">2026</span>
            </div>
        </header>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($mountains as $mountain)
                <div class="group relative overflow-hidden rounded-2xl bg-zinc-900 border border-zinc-800 transition-all hover:border-zinc-500 {{ $loop->first ? 'md:col-span-2 md:row-span-2' : '' }}">
                    <!-- Foto Utama -->
                    <img src="{{ asset('storage/' . $mountain->photos[0]) }}" class="h-full w-full object-cover opacity-60 group-hover:scale-105 group-hover:opacity-100 transition-all duration-700">
                    
                    <!-- Overlay Info -->
                    <div class="absolute bottom-0 left-0 p-6 w-full bg-gradient-to-t from-black/90 to-transparent">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-xs font-mono text-emerald-500 uppercase">{{ $mountain->climb_date->format('M Y') }}</p>
                                <h2 class="text-2xl font-bold">{{ $mountain->name }}</h2>
                                <p class="text-sm text-zinc-400">{{ $mountain->location }} — {{ $mountain->height }} MDPL</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>