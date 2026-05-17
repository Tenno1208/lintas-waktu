<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summit Memories</title>
    <!-- Jalankan Vite untuk compile Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0a] text-zinc-100 antialiased">

    <!-- Konten dari welcome.blade.php akan masuk ke $slot -->
    {{ $slot }}

</body>
</html>