<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(
            array_merge($this->otherData(true), [
                'name' => 'admin',
                'furigana' => 'admin',
                'role' => User::ADMIN,
                'email' => 'admin@admin.admin',
                'password' => 'adminp@ssword1234',
            ])
        );
        User::factory()->create(
            array_merge($this->otherData(false), [
                'name' => 'user',
                'furigana' => 'user',
                'role' => User::USER,
                'email' => 'user@user.user',
                'password' => 'p@ssword1234',
            ])
        );
        for ($i = 0; $i < 10; $i++) {
            User::factory()->create(
                array_merge($this->otherData(false), [
                    'name' => fake()->name(),
                    'furigana' => fake()->name(),
                    'role' => User::USER,
                    'email' => fake()->email(),
                    'password' => 'p@ssword1234',
                ])
            );
        }
    }

    public function otherData(bool $isAdmin = false): array
    {
        return [
            'phone_number' => '000-0000-0000',
            'post_code' => 5320011,
            'address' => '西中島南方',
            'building' => 'NLC Building',
            'preferred_contact_time' => $isAdmin ? null : '9-12',
            'is_newsletter_subscription' => $isAdmin ? FALSE : rand(0, 1),
        ];
    }
}
