<!-- Bagian atas card foto di dalam loop -->
<div class="flex justify-between items-start w-full">
    <span class="text-xs font-mono text-zinc-400 bg-black/50 px-2.5 py-1 rounded-md backdrop-blur-sm">
        {{ $memory->event_date->format('d / m / Y') }}
    </span>
    
    <!-- Badge Dinamis Berdasarkan Kategori -->
    @if($memory->category == 'adventure')
        <span class="text-[10px] font-mono uppercase bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded border border-emerald-500/20">Mountaineering</span>
    @elseif($memory->category == 'school')
        <span class="text-[10px] font-mono uppercase bg-blue-500/10 text-blue-400 px-2 py-0.5 rounded border border-blue-500/20">Highschool Era</span>
    @elseif($memory->category == 'graduation')
        <span class="text-[10px] font-mono uppercase bg-amber-500/10 text-amber-400 px-2 py-0.5 rounded border border-amber-500/20">Graduation</span>
    @endif
</div>