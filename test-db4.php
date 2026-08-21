<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$u = App\Models\Umkm::all();
foreach($u as $i) {
    echo $i->id . ' - ' . $i->store_name . ' - Image: ' . $i->image . "\n";
}

echo "--- NEWS ---\n";
$n = App\Models\News::all();
foreach($n as $i) {
    echo $i->id . ' - ' . $i->title . ' - Thumbnail: ' . $i->thumbnail . "\n";
}
