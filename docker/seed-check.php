<?php
/**
 * Database Seed Check for Render & Docker
 *
 * Ensures that whenever the database is fresh/empty (e.g. initial deployment or SQLite fallback),
 * all categories, products, specs, and admin accounts are populated so the store is instantly usable.
 */

$appRoot = realpath(__DIR__ . '/..') ?: '/var/www/html';
require $appRoot . '/vendor/autoload.php';

/** @var \Illuminate\Foundation\Application $app */
$app = require_once $appRoot . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (!\Illuminate\Support\Facades\Schema::hasTable('products')) {
        echo "[SEED-CHECK] 'products' table does not exist. Running migrations..." . PHP_EOL;
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }

    $count = \Illuminate\Support\Facades\DB::table('products')->count();
    echo "[SEED-CHECK] Current product count: {$count}" . PHP_EOL;

    if ($count === 0) {
        echo "[SEED-CHECK] Store catalog is empty. Running DatabaseSeeder..." . PHP_EOL;
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'DatabaseSeeder',
            '--force' => true,
        ]);
        $afterCount = \Illuminate\Support\Facades\DB::table('products')->count();
        echo "[SEED-CHECK] Seeding completed. {$afterCount} products created successfully." . PHP_EOL;
    } else {
        echo "[SEED-CHECK] Database already initialized ({$count} products found). Skipping seeder." . PHP_EOL;
    }
} catch (Throwable $e) {
    echo "[SEED-CHECK] Notice during seeding check: " . $e->getMessage() . PHP_EOL;
}
