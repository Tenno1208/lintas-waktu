<x-layout>
    <!-- Komponen Navigasi -->
    <x-navbar />

    <div class="max-w-6xl mx-auto px-6 pb-24">
        <!-- Komponen Hero Section -->
        <x-hero />

        <!-- Komponen Statistik (Mengirim data $mountains) -->
        <x-stats :mountains="$mountains" />

        <!-- Komponen Bento Grid Gallery (Mengirim data $mountains) -->
        <x-bento-grid :mountains="$mountains" />
    </div>
</x-layout>