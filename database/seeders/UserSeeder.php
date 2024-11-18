<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create(
            [
                'name' => 'admin',
                'furigana' => 'admin',
                'email' => 'admin@admin.admin',
                'password' => 'adminp@ssword1234',
                'email_verified_at' => Carbon::now(),
            ]
        );
        User::factory()->user()->create(
            [
                'name' => 'user',
                'furigana' => 'user',
                'email' => 'user@user.user',
                'password' => 'p@ssword1234',
                'email_verified_at' => Carbon::now(),
            ]
        );
        User::factory(8)->randomUser()->create();
    }
}
