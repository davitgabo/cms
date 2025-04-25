<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::insert([
            ['title' => 'news', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'events', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
