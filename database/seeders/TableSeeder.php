<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            ['table_number' => 'T001', 'capacity' => 4, 'area' => 'indoor'],
            ['table_number' => 'T002', 'capacity' => 4, 'area' => 'indoor'],
            ['table_number' => 'T003', 'capacity' => 4, 'area' => 'indoor'],
            ['table_number' => 'T004', 'capacity' => 4, 'area' => 'indoor'],
            ['table_number' => 'T005', 'capacity' => 4, 'area' => 'outdoor'],
            ['table_number' => 'T006', 'capacity' => 4, 'area' => 'outdoor'],
            ['table_number' => 'T007', 'capacity' => 4, 'area' => 'vip'],
            ['table_number' => 'T008', 'capacity' => 4, 'area' => 'vip'],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
