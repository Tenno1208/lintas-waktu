<x-layout>
    <x-navbar />

    <div class="max-w-3xl mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('admin.index') }}" class="text-zinc-600 hover:text-emerald-400 font-mono text-[10px] tracking-widest transition-colors uppercase">← Kembali ke Dashboard</a>
            <h1 class="text-xl font-bold font-mono uppercase tracking-wider text-zinc-100 mt-2 flex items-center gap-2">
                <span class="text-emerald-500">//</span> Arsip Memori Baru
            </h1>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-[#09090b] border border-zinc-900 p-6 md:p-8 rounded-2xl shadow-2xl">
            @csrf
            
            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Judul Memori</label>
                <input type="text" name="title" required placeholder="Contoh: Puncak Merbabu via Selo / Wisuda Angkatan 2026" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Kategori</label>
                    <select name="category" required class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                        <option value="adventure">Adventure (Gunung)</option>
                        <option value="school">School Days (Sekolah)</option>
                        <option value="graduation">Graduation (Wisuda)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Tanggal Kejadian</label>
                    <input type="date" name="event_date" required class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Lokasi</label>
                    <input type="text" name="location" placeholder="Misal: Jawa Tengah / Gedung Serbaguna" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Ketinggian (Khusus Gunung - Opsional)</label>
                    <input type="number" name="height_mdpl" placeholder="Contoh: 3142 mdpl" class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Cerita / Narasi Pendek</label>
                <textarea name="story" rows="4" placeholder="Tulis catatan perjalanan atau kenangan berkesan di sini..." class="w-full bg-[#030303] border border-zinc-900 focus:border-emerald-500/50 rounded-xl px-4 py-3 text-sm text-zinc-200 focus:outline-none transition-all resize-none"></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Dokumentasi Gambar (Multi-Upload)</label>
                
                <div class="relative group border border-dashed border-zinc-800 hover:border-emerald-500/30 bg-[#050505] rounded-xl p-6 transition-all duration-300 text-center cursor-pointer">
                    <input type="file" name="photos[]" id="photo-input" multiple accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    
                    <div class="space-y-2 pointer-events-none">
                        <svg class="w-8 h-8 text-zinc-600 group-hover:text-emerald-400 mx-auto transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs text-zinc-400"><span class="text-emerald-400 font-semibold">Klik untuk memilih</span> atau seret beberapa foto sekaligus</p>
                        <p class="text-[10px] text-zinc-600 font-mono">Format: PNG, JPG, JPEG up to 2MB</p>
                    </div>
                </div>

                <div id="preview-container" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3 mt-4">
                    </div>
            </div>

            <div class="pt-4 border-t border-zinc-900 flex flex-col sm:flex-row gap-3">
                <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-black font-mono font-bold py-3.5 rounded-xl transition-all uppercase text-xs tracking-widest shadow-[0_0_20px_rgba(16,185,129,0.1)]">
                    KUNCI KE DALAM LINI MASA
                </button>
            </div>
        </form>
    </div>
</x-layout>

<script>
    document.getElementById('photo-input').addEventListener('change', function(event) {
        const container = document.getElementById('preview-container');
        container.innerHTML = ''; // Reset wadah preview lama
        
        const files = event.target.files;
        
        if (files) {
            Array.from(files).forEach((file) => {
                // Pastikan file berupa gambar
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Membuat elemen box preview
                        const wrapper = document.createElement('div');
                        wrapper.className = 'relative aspect-square bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden shadow-inner group/item';
                        
                        wrapper.innerHTML = `
                            <img src="${e.target.result}" class="h-full w-full object-cover opacity-80 group-hover/item:scale-105 group-hover/item:opacity-100 transition-all duration-300">
                            <div class="absolute bottom-1 left-1 right-1 bg-black/60 text-[8px] font-mono px-1.5 py-0.5 rounded text-zinc-400 truncate text-center backdrop-blur-xs">
                                ${(file.size / 1024 / 1024).toFixed(1)} MB
                            </div>
                        `;
                        
                        container.appendChild(wrapper);
                    }
                    
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>