<?php

require __DIR__ . "/../vendor/autoload.php";

use App\Models\Module;

$app = require __DIR__ . "/../bootstrap/app.php";

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$modules = Module::orderBy('order')->get();

foreach ($modules as $m) {
    echo sprintf("%d: %s (type=%s, active=%s)\n", $m->order, $m->name, $m->toque_type, $m->is_active ? 'yes' : 'no');
}
