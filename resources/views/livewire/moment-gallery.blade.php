<div>
    <!-- Filter Kategori -->
    <div class="flex justify-center gap-6 mb-12">
        @foreach(['all', 'gunung', 'sekolah', 'wisuda'] as $cat)
            <button wire:click="$set('category', '{{ $cat }}')" 
                class="{{ $category == $cat ? 'border-b-2 border-waktu-gold' : '' }} uppercase text-sm tracking-widest">
                {{ $cat }}
            </button>
        @endforeach
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($moments as $moment)
            <div class="group cursor-pointer">
                <div class="overflow-hidden aspect-[4/5] bg-gray-200 mb-4">
                    <img src="{{ asset('storage/' . $moment->image_path) }}" 
                        class="object-cover w-full h-full group-hover:scale-105 transition duration-500">
                </div>
                <h3 class="font-serif text-xl">{{ $moment->title }}</h3>
                <div class="flex justify-between items-center text-xs opacity-60 mt-2 uppercase tracking-tighter">
                    <span>{{ $moment->event_date->format('M Y') }}</span>
                    @if($moment->category == 'gunung')
                        <span>{{ $moment->elevation }} MDPL</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>