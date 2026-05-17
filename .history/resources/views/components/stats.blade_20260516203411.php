@props(['memories'])

@php
    $totalAdventure = $memories->where('category', 'adventure')->count();
    $totalSchool = $memories->where('category', 'school')->count();
    $totalGraduation = $memories->where('category', 'graduation')->count();
@endphp

<section class="grid grid-cols-3 gap-4 mb-12">
    <div class="bg-[#09090b] border border-zinc-900 p-4 md:p-6 rounded-2xl flex flex-col justify-between">
        <span class="text-[10px] md:text-xs font-mono text-zinc-500 uppercase tracking-wider">🗻 Adventure</span>
        <span class="text-2xl md:text-4xl font-bold tracking-tight mt-2 text-zinc-200">{{ $totalAdventure }} <span class="text-xs md:text-sm font-normal text-zinc-500">Track</span></span>
    </div>
    <div class="bg-[#09090b] border border-zinc-900 p-4 md:p-6 rounded-2xl flex flex-col justify-between">
        <span class="text-[10px] md:text-xs font-mono text-zinc-500 uppercase tracking-wider">🏫 School Days</span>
        <span class="text-2xl md:text-4xl font-bold tracking-tight mt-2 text-zinc-200">{{ $totalSchool }} <span class="text-xs md:text-sm font-normal text-zinc-500">Momen</span></span>
    </div>
    <div class="bg-[#09090b] border border-zinc-900 p-4 md:p-6 rounded-2xl flex flex-col justify-between">
        <span class="text-[10px] md:text-xs font-mono text-zinc-500 uppercase tracking-wider">🎓 Graduation</span>
        <span class="text-2xl md:text-4xl font-bold tracking-tight mt-2 text-emerald-400">{{ $totalGraduation }} <span class="text-xs md:text-sm font-normal text-zinc-500">Milestone</span></span>
    </div>
</section>