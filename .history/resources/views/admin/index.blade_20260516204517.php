<x-layout>
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-2xl font-bold font-mono uppercase tracking-tighter">Admin Dashboard</h1>
            <a href="{{ route('admin.create') }}" class="bg-emerald-500 text-black px-4 py-2 rounded-lg text-xs font-bold hover:bg-emerald-400 transition-all">
                + TAMBAH MEMORI
            </a>
        </div>

        <div class="bg-zinc-950 border border-zinc-900 rounded-2xl overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-900 text-zinc-500 font-mono text-[10px] uppercase">
                    <tr>
                        <th class="px-6 py-4">Memori</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900">
                    @foreach($memories as $m)
                    <tr class="hover:bg-zinc-900/50 transition-colors">
                        <td class="px-6 py-4 font-medium">{{ $m->title }}</td>
                        <td class="px-6 py-4 uppercase text-[10px] tracking-widest text-emerald-500">{{ $m->category }}</td>
                        <td class="px-6 py-4 text-zinc-500">{{ $m->event_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus memori ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-400 text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <a href="/" class="text-zinc-600 text-xs hover:text-zinc-400">← Kembali ke Web Utama</a>
        </div>
    </div>
</x-layout>