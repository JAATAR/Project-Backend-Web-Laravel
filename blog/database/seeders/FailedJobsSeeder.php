<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FailedJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('failed_jobs')->insert([
            'uuid' => '1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o6p',
            'connection' => 'database',
            'queue' => 'default',
            'payload' => json_encode(['data' => '...']),
            'exception' => 'Exception message goes here',
            'failed_at' => now(),
        ]);

    }
}
