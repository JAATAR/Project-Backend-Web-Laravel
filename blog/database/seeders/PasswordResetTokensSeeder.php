<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('password_reset_tokens')->insert([
            'email' => 'john@example.com',
            'token' => Str::random(60),
            'created_at' => now(),
        ]);
        //Password Reset Tokens added
    }
}
