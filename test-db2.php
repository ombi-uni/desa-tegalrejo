<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "--- NEWS ---\n";
echo json_encode(App\Models\News::first()->toArray(), JSON_PRETTY_PRINT);
echo "\n--- UMKM ---\n";
echo json_encode(App\Models\Umkm::first()->toArray(), JSON_PRETTY_PRINT);
