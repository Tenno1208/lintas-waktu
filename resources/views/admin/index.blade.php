<x-layout>
    <x-navbar />

    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="border-b border-zinc-900 pb-6 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="select-none">
                <h1 class="text-xl font-bold font-mono uppercase tracking-wider text-zinc-100 flex items-center gap-2">
                    <span class="text-emerald-500">//</span> KENDALI ARSIP
                </h1>
                <p class="text-xs text-zinc-500 font-light mt-1">Kelola seluruh lini masa, jejak petualangan, dan memori lintas waktu.</p>
            </div>
            
            <a href="{{ route('admin.create') }}" class="w-full sm:w-auto text-center bg-zinc-900 border border-zinc-800 hover:border-emerald-500/50 text-zinc-300 font-mono text-xs tracking-widest px-5 py-3 rounded-xl transition-all uppercase select-none">
                + INTEGRASIKAN MEMORI BARU
            </a>
        </div>

        <div class="bg-[#09090b] border border-zinc-900 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs md:text-sm">
                    <thead class="bg-zinc-900/60 text-zinc-500 font-mono text-[10px] uppercase tracking-widest border-b border-zinc-900 select-none">
                        <tr>
                            <th class="px-6 py-4">Preview & Judul Memori</th>
                            <th class="px-6 py-4 hidden md:table-cell">Kategori</th>
                            <th class="px-6 py-4">Tanggal Kejadian</th>
                            <th class="px-6 py-4 text-center w-40">Opsi Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900/60">
                        @forelse($memories as $m)
                        <tr class="hover:bg-zinc-900/10 transition-all group">
                            <td class="px-6 py-4 font-medium text-zinc-200">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-lg bg-zinc-900 border border-zinc-800 overflow-hidden flex-shrink-0 relative select-none">
                                        @if(!empty($m->photos) && isset($m->photos[0]))
                                            <img src="{{ asset('storage/' . $m->photos[0]) }}" class="h-full w-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-300">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-zinc-700 font-mono text-[8px]">NULL</div>
                                        @endif
                                    </div>
                                    <div class="truncate max-w-xs sm:max-w-md">
                                        <span class="text-zinc-200 group-hover:text-emerald-400 transition-colors font-semibold block truncate text-xs md:text-sm">{{ $m->title }}</span>
                                        <span class="text-[9px] font-mono text-zinc-500 block md:hidden uppercase tracking-wider text-emerald-500 mt-0.5">{{ $m->category }}</span>
                                        <span class="text-[10px] font-mono text-zinc-600 block truncate mt-0.5">{{ $m->location ?? 'Tanpa Lokasi' }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 hidden md:table-cell select-none">
                                @if($m->category == 'adventure')
                                    <span class="text-[9px] font-mono uppercase tracking-wider bg-emerald-500/10 text-emerald-400 px-2.5 py-1 rounded-lg border border-emerald-500/20">Adventure</span>
                                @elseif($m->category == 'school')
                                    <span class="text-[9px] font-mono uppercase tracking-wider bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded-lg border border-blue-500/20">School Days</span>
                                @elseif($m->category == 'graduation')
                                    <span class="text-[9px] font-mono uppercase tracking-wider bg-amber-500/10 text-amber-400 px-2.5 py-1 rounded-lg border border-amber-500/20">Graduation</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 font-mono text-zinc-400 text-xs select-none">{{ $m->event_date->format('d / m / Y') }}</td>
                            
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.edit', $m->id) }}" class="border border-zinc-800 hover:border-emerald-500/40 bg-zinc-950/40 text-zinc-500 hover:text-emerald-400 font-mono text-[9px] px-3 py-1.5 rounded-lg transition-all uppercase tracking-wider">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus memori permanen ini?')" class="inline m-0">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="font-mono text-[9px] tracking-wider text-zinc-600 hover:text-red-400 border border-zinc-900 hover:border-red-500/20 bg-zinc-950/20 px-3 py-1.5 rounded-lg transition-all uppercase">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-zinc-600 font-mono text-xs select-none">
                                [ PANGKALAN DATA REKAMAN KOSONG // SILAKAN TAMBAH MEMORI BARU ]
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>