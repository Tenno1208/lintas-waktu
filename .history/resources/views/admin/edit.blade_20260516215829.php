<x-layout>
    <x-navbar />

    <div class="max-w-3xl mx-auto px-6 py-12">
        <div class="mb-8 select-none">
            <a href="{{ route('admin.index') }}" class="text-zinc-600 hover:text-emerald-400 font-mono text-[10px] tracking-widest transition-colors uppercase">← Kembali ke Dashboard</a>
            <h1 class="text-xl font-bold font-mono uppercase tracking-wider text-zinc-100 mt-2 flex items-center gap-2">
                <span class="text-emerald-500">//</span> Edit Memori Arsip
            </h1>
        </div>

        <form action="{{ route('admin.update', $memory->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-[#09090b] border border-zinc-900 p-6 md:p-8 rounded-2xl shadow-2xl">
            @csrf
            @method('PUT') {{-- WAJIB: Laravel butuh ini untuk memproses route bertipe PUT --}}
            
            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Judul Memori</label>
                <input type="text" name="title" value="{{ $memory->title }}" required class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Kategori</label>
                    <select name="category" required class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all cursor-pointer">
                        <option value="adventure" {{ $memory->category == 'adventure' ? 'selected' : '' }}>Adventure (Gunung)</option>
                        <option value="school" {{ $memory->category == 'school' ? 'selected' : '' }}>School Days (Sekolah)</option>
                        <option value="graduation" {{ $memory->category == 'graduation' ? 'selected' : '' }}>Graduation (Wisuda)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Tanggal Kejadian</label>
                    <input type="date" name="event_date" value="{{ $memory->event_date->format('Y-m-d') }}" required class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Lokasi</label>
                    <input type="text" name="location" value="{{ $memory->location }}" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Ketinggian (Khusus Gunung - Opsional)</label>
                    <input type="number" name="height_mdpl" value="{{ $memory->height_mdpl }}" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Iframe / Koordinat Jalur Peta (Khusus Gunung - Opsional)</label>
                <input type="text" name="gpx_track" value="{{ $memory->gpx_track }}" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Cerita / Narasi Pendek</label>
                <textarea name="story" rows="4" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all resize-none">{{ $memory->story }}</textarea>
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2 select-none">Ganti Dokumen Foto (Kosongkan jika tidak ingin mengubah foto lama)</label>
                
                <div class="relative group border border-dashed border-zinc-800 hover:border-emerald-500/30 bg-[#050505] rounded-xl p-6 transition-all duration-300 text-center cursor-pointer select-none">
                    <input type="file" name="photos[]" id="photo-input" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div class="space-y-2 pointer-events-none">
                        <svg class="w-8 h-8 text-zinc-600 group-hover:text-emerald-400 mx-auto transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs text-zinc-400"><span class="text-emerald-400 font-semibold">Upload Foto Baru</span> untuk menimpa semua album foto lama</p>
                    </div>
                </div>

                <div id="preview-container" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3 mt-4">
                    @if(!empty($memory->photos))
                        @foreach($memory->photos as $photo)
                            <div class="relative aspect-square bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden opacity-50">
                                <img src="{{ asset('storage/' . $photo) }}" class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="pt-4 border-t border-zinc-900 flex gap-3 select-none">
                <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-black font-mono font-bold py-3.5 rounded-xl transition-all uppercase text-xs tracking-widest shadow-[0_0_20px_rgba(16,185,129,0.1)]">
                    SIMPAN PERUBAHAN DATA
                </button>
            </div>
        </form>
    </div>
</x-layout>

<script>
    // Script live preview yang sama untuk mendeteksi jika user memilih file foto baru
    let selectedFiles = new DataTransfer();
    const photoInput = document.getElementById('photo-input');
    const container = document.getElementById('preview-container');

    photoInput.addEventListener('change', function(event) {
        const files = event.target.files;
        if (!files) return;
        selectedFiles.items.clear(); // Bersihkan preview foto lama karena akan ditimpa penuh

        Array.from(files).forEach((file) => {
            if (file.type.startsWith('image/')) { selectedFiles.items.add(file); }
        });
        photoInput.files = selectedFiles.files;
        renderPreviews();
    });

    function renderPreviews() {
        container.innerHTML = '';
        Array.from(selectedFiles.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative aspect-square bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden';
                wrapper.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
                container.appendChild(wrapper);
            }
            reader.readAsDataURL(file);
        });
    }
</script>