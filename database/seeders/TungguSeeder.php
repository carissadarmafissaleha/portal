<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TungguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tunggus')->insert([
            [
                'nama' => 'BLK 1',
            ],
            [
                'nama' => 'BLK 2',
            ],
            [
                'nama' => 'RUMAH',
            ],
            [
                'nama' => 'NEGARA KERJA',
            ],
        ]);
    }
}
