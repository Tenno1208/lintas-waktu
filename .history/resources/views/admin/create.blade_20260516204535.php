<x-layout>
    <div class="max-w-3xl mx-auto px-6 py-12">
        <h1 class="text-2xl font-bold font-mono uppercase tracking-tighter mb-8 text-emerald-500">Arsip Memori Baru</h1>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-zinc-950 border border-zinc-900 p-8 rounded-2xl">
            @csrf
            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Judul Memori</label>
                <input type="text" name="title" required class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-zinc-100 focus:outline-none focus:border-emerald-500 transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Kategori</label>
                    <select name="category" required class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-zinc-100 focus:outline-none focus:border-emerald-500 transition-all">
                        <option value="adventure">Adventure (Gunung)</option>
                        <option value="school">School Days (Sekolah)</option>
                        <option value="graduation">Graduation (Wisuda)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Tanggal Kejadian</label>
                    <input type="date" name="event_date" required class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-zinc-100 focus:outline-none focus:border-emerald-500 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Lokasi</label>
                    <input type="text" name="location" placeholder="Misal: Merbabu / SMAN 1" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-zinc-100 focus:outline-none focus:border-emerald-500 transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Ketinggian (Opsional)</label>
                    <input type="number" name="height_mdpl" placeholder="mdpl" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-zinc-100 focus:outline-none focus:border-emerald-500 transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Cerita / Story</label>
                <textarea name="story" rows="4" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-zinc-100 focus:outline-none focus:border-emerald-500 transition-all"></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase mb-2">Upload Foto (Bisa banyak)</label>
                <input type="file" name="photos[]" multiple class="w-full text-zinc-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700 transition-all">
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 bg-emerald-500 text-black font-bold py-3 rounded-xl hover:bg-emerald-400 transition-all uppercase text-xs tracking-widest">Simpan Memori</button>
                <a href="{{ route('admin.index') }}" class="px-6 py-3 border border-zinc-800 rounded-xl text-xs font-mono flex items-center hover:bg-zinc-900 transition-all uppercase">Batal</a>
            </div>
        </form>
    </div>
</x-layout>