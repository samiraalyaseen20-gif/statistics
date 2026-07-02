<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (\App\Models\ClinicUnit::withCount('visits')->get() as $c) {
    echo $c->name . ': ' . $c->visits_count . "\n";
}
