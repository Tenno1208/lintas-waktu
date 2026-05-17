<?php

// Paksa hapus penunjuk cache lama jika entah bagaimana terbaca oleh serverless runtime
$cachedConfig = __DIR__ . '/../bootstrap/cache/config.php';
if (file_exists($cachedConfig)) {
    @unlink($cachedConfig);
}

$cachedServices = __DIR__ . '/../bootstrap/cache/services.php';
if (file_exists($cachedServices)) {
    @unlink($cachedServices);
}

// Teruskan request ke public index bawaan Laravel
require __DIR__ . '/../public/index.php';