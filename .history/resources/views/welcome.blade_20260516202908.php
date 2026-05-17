<x-layout>
    <!-- Landing Gate (Halaman Pertama Kali Buka Web) -->
    <x-landing-gate />

    <!-- Komponen Navigasi -->
    <x-navbar />

    <div class="max-w-6xl mx-auto px-6 pb-24">
        <!-- Komponen Hero Section -->
        <x-hero />

        <!-- Komponen Statistik -->
        <x-stats :mountains="$mountains" />

        <!-- Komponen Bento Grid Gallery -->
        <x-bento-grid :mountains="$mountains" />
    </div>
</x-layout>