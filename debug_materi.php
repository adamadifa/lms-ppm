<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Materi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

echo "=== Debug Materi Authorization ===\n\n";

// Check all materi
$materi = Materi::all();
echo "Total Materi: " . $materi->count() . "\n\n";

foreach ($materi as $m) {
    echo "Materi ID: " . $m->id . "\n";
    echo "Judul: " . $m->judul . "\n";
    echo "Guru ID: " . $m->guru_id . "\n";

    // Check if guru exists
    $guru = User::find($m->guru_id);
    if ($guru) {
        echo "Guru Name: " . $guru->name . "\n";
        echo "Guru Email: " . $guru->email . "\n";
        echo "Guru Roles: " . $guru->getRoleNames()->implode(', ') . "\n";
    } else {
        echo "Guru NOT FOUND!\n";
    }
    echo "---\n";
}

// Check users with guru role
echo "\n=== Users with Guru Role ===\n";
$guruUsers = User::role('guru')->get();
foreach ($guruUsers as $user) {
    echo "User ID: " . $user->id . "\n";
    echo "Name: " . $user->name . "\n";
    echo "Email: " . $user->email . "\n";
    echo "---\n";
}

// Check materi without guru_id
echo "\n=== Materi without guru_id ===\n";
$materiWithoutGuru = Materi::whereNull('guru_id')->orWhere('guru_id', 0)->get();
if ($materiWithoutGuru->count() > 0) {
    foreach ($materiWithoutGuru as $m) {
        echo "Materi ID: " . $m->id . " - " . $m->judul . " (No guru_id)\n";
    }
} else {
    echo "All materi have guru_id\n";
}
