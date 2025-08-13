<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Materi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

echo "=== Fix Materi Guru ID ===\n\n";

// Get first guru user
$guruUser = User::role('guru')->first();
if (!$guruUser) {
    echo "No guru user found! Please create a guru user first.\n";
    exit;
}

echo "Using Guru User: " . $guruUser->name . " (ID: " . $guruUser->id . ")\n\n";

// Fix materi without guru_id
$materiWithoutGuru = Materi::whereNull('guru_id')->orWhere('guru_id', 0)->get();
if ($materiWithoutGuru->count() > 0) {
    echo "Found " . $materiWithoutGuru->count() . " materi without guru_id\n";

    foreach ($materiWithoutGuru as $materi) {
        echo "Fixing Materi ID: " . $materi->id . " - " . $materi->judul . "\n";
        $materi->update(['guru_id' => $guruUser->id]);
    }

    echo "Fixed " . $materiWithoutGuru->count() . " materi\n";
} else {
    echo "All materi already have guru_id\n";
}

// Verify fix
echo "\n=== Verification ===\n";
$materi = Materi::all();
foreach ($materi as $m) {
    echo "Materi ID: " . $m->id . " - Guru ID: " . $m->guru_id . "\n";
}

echo "\nFix completed!\n";
