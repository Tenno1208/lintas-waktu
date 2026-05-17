<x-layout>
    <!-- 1. Landing Gate (Splash Screen) -->
    <x-landing-gate />

    <!-- 2. Navbar -->
    <x-navbar />

    <div class="max-w-6xl mx-auto px-6 pb-24">
        <!-- 3. Hero Section -->
        <x-hero />

        <!-- 4. Stats Dashboard Counter -->
        <x-stats :memories="$memories" />

        <!-- 5. Bento Grid Photo Gallery -->
        <x-bento-grid :memories="$memories" />
    </div>
</x-layout>