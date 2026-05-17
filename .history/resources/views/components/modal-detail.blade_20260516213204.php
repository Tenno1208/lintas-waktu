<div 
    x-show="open" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[200] flex items-center justify-center p-0 md:p-6 bg-black/98 backdrop-blur-2xl"
    @keydown.escape.window="open = false"
    @keydown.right.window="if(selected && selected.photos.length > 1 && activeTab === 'photos') nextPhoto()"
    @keydown.left.window="if(selected && selected.photos.length > 1 && activeTab === 'photos') prevPhoto()"
    style="display: none;"
    x-data="{ activeTab: 'photos' }" {{-- Mengatur tab aktif default: foto --}}
    @click.away="open = false; activeTab = 'photos'"
>
    <div class="bg-[#050505] md:border md:border-zinc-900 w-full max-w-7xl h-full md:h-[90vh] overflow-hidden md:rounded-[2.5rem] flex flex-col md:flex-row shadow-2xl">
        
        <div class="w-full md:w-8/12 h-[50vh] md:h-full bg-[#020202] relative flex flex-col justify-between p-4 border-b md:border-b-0 md:border-r border-zinc-900 select-none">
            
            <template x-if="selected?.category === 'adventure' && selected?.gpx_track">
                <div class="absolute top-4 left-4 z-30 flex gap-2 bg-black/60 border border-zinc-900 p-1 rounded-xl backdrop-blur-md">
                    <button @click="activeTab = 'photos'" :class="activeTab === 'photos' ? 'bg-zinc-100 text-black font-bold' : 'text-zinc-400 hover:text-white'" class="px-3 py-1 rounded-lg text-[10px] font-mono uppercase transition-all">
                        📷 Galeri Foto
                    </button>
                    <button @click="activeTab = 'map'" :class="activeTab === 'map' ? 'bg-emerald-500 text-black font-bold' : 'text-zinc-400 hover:text-emerald-400'" class="px-3 py-1 rounded-lg text-[10px] font-mono uppercase transition-all">
                        🗻 Jalur Track
                    </button>
                </div>
            </template>

            <div x-show="activeTab === 'photos'" class="w-full flex-1 flex items-center justify-center relative overflow-hidden h-full">
                <template x-if="selected">
                    <img :src="'/storage/' + selected.photos[currentPhotoIndex]" class="max-w-full max-h-[40vh] md:max-h-[70vh] w-auto h-auto object-contain rounded-xl shadow-2xl transition-all duration-300">
                </template>

                <template x-if="selected && selected.photos.length > 1">
                    <div>
                        <button @click="prevPhoto()" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white p-2.5 rounded-xl transition-all backdrop-blur-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="nextPhoto()" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white p-2.5 rounded-xl transition-all backdrop-blur-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </template>
            </div>

            <div x-show="activeTab === 'map'" class="w-full flex-1 rounded-2xl overflow-hidden border border-zinc-900 bg-zinc-950/40 relative h-full">
                <template x-if="selected?.gpx_track">
                    <div class="w-full h-full p-2 flex items-center justify-center">
                        <template x-if="selected.gpx_track.includes('<iframe')">
                            <div class="w-full h-full rounded-xl overflow-hidden opacity-80 hover:opacity-100 transition-opacity" x-html="selected.gpx_track"></div>
                        </template>
                        <template x-if="!selected.gpx_track.includes('<iframe')">
                            <iframe class="w-full h-full rounded-xl border-0 opacity-70 invert grayscale brightness-90 contrast-125" :src="'https://maps.google.com/maps?q=' + encodeURIComponent(selected.gpx_track) + '&t=k&z=13&ie=UTF8&iwloc=&output=embed'"></iframe>
                        </template>
                    </div>
                </template>
            </div>

            <template x-if="selected && selected.photos.length > 1 && activeTab === 'photos'">
                <div class="w-full flex justify-center gap-2 overflow-x-auto py-2 custom-scrollbar max-h-16">
                    <template x-for="(photo, index) in selected.photos" :key="index">
                        <button @click="currentPhotoIndex = index" class="h-10 w-14 rounded-md overflow-hidden border flex-shrink-0 transition-all duration-300" :class="currentPhotoIndex === index ? 'border-emerald-500 scale-105 shadow-md shadow-emerald-500/10' : 'border-zinc-800 opacity-40 hover:opacity-100'">
                            <img :src="'/storage/' + photo" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </template>
        </div>

        <div class="w-full md:w-4/12 p-6 md:p-10 overflow-y-auto flex flex-col justify-between h-[50vh] md:h-full bg-[#050505]">
            <div>
                <div class="flex justify-between items-start mb-6">
                    <span class="text-[9px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full uppercase tracking-[0.2em]" x-text="selected?.category"></span>
                    <button @click="open = false; activeTab = 'photos'" class="text-zinc-500 hover:text-zinc-200 border border-zinc-900 p-1.5 rounded-lg transition-colors bg-zinc-950/40">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <h2 class="text-2xl md:text-4xl font-black text-zinc-100 uppercase tracking-tighter leading-tight mb-4" x-text="selected?.title"></h2>
                
                <div class="flex flex-wrap gap-x-4 gap-y-2 mb-6 border-y border-zinc-900 py-3 font-mono text-[9px] text-zinc-500 uppercase tracking-widest">
                    <div class="flex flex-col">
                        <span class="text-zinc-700">Tanggal</span>
                        <span class="text-zinc-300 mt-0.5" x-text="new Date(selected?.event_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})"></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-zinc-700">Lokasi</span>
                        <span class="text-zinc-300 mt-0.5" x-text="selected?.location || 'Tidak Ada Data'"></span>
                    </div>
                    <template x-if="selected?.height_mdpl">
                        <div class="flex flex-col">
                            <span class="text-zinc-700">Elevasi</span>
                            <span class="text-emerald-400 font-bold mt-0.5" x-text="selected?.height_mdpl + ' MDPL'"></span>
                        </div>
                    </template>
                </div>

                <template x-if="selected?.category === 'school' || selected?.category === 'graduation'">
                    <div class="mb-4 bg-zinc-950 border border-zinc-900 p-4 rounded-xl relative overflow-hidden">
                        <span class="absolute right-2 bottom-0 text-7xl font-serif text-zinc-900 pointer-events-none select-none">“</span>
                        <span class="text-[10px] font-mono text-zinc-600 block uppercase tracking-wider mb-1">Yearbook Quote //</span>
                        <p class="text-xs text-zinc-300 italic font-light">"Berhasil menyelesaikan chapter ini. Siap mengunci memori dan membuka lembaran baru lintas waktu berikutnya."</p>
                    </div>
                </template>

                <p class="text-zinc-400 text-xs md:text-sm leading-relaxed font-light whitespace-pre-line custom-scrollbar" x-text="selected?.story"></p>
            </div>

            <div class="mt-8 pt-4 border-t border-zinc-900/60 flex justify-between items-center text-[9px] font-mono text-zinc-700 uppercase tracking-widest select-none">
                <div>LINTAS WAKTU ARCHIVE</div>
                <template x-if="selected && selected.photos.length > 1 && activeTab === 'photos'">
                    <div class="text-zinc-500 font-bold bg-zinc-900/60 border border-zinc-800/60 px-2 py-0.5 rounded-md" x-text="(currentPhotoIndex + 1) + ' / ' + selected.photos.length"></div>
                </template>
            </div>
        </div>
    </div>
</div>