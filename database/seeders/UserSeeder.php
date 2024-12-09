<?php

namespace Database\Seeders;

use App\Enums\CallTimeEnum;
use App\Models\User;
use Database\Factories\UserFactory;
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
                'loginid' => '0000000001',
                'name' => 'admin',
                'name_furigana' => 'admin',
                'email' => 'admin@admin.admin',
                'password' => 'adminp@ssword1234',
                'email_verified_at' => Carbon::now(),
            ]
        );
        User::factory()->user()->create(
            [
                'loginid' => '0000000002',
                'name' => 'user',
                'name_furigana' => 'user',
                'email' => 'user@user.user',
                'password' => 'p@ssword1234',
                'email_verified_at' => Carbon::now(),
            ]
        );
        User::factory(5)->randomUser()->create();
    }

    public function loginUser(): object
    {
        return (object) $user = [
            'loginid' => '0000000002',
            'email' => 'user@user.user',
            'password' => 'p@ssword1234',
        ];
    }

    public function registerUser(): object
    {
        $userFactory = new UserFactory();
        $call_time = CallTimeEnum::cases();
        $zipcode = ['5320011', '1000000', '4500001'];
        return (object) [
            'loginid' => '0000000003',
            'name' => 'usera',
            'furigana' => 'usera',
            'email' => 'usera@usera.usera',
            'password' => 'p@ssword1234',
            'phone_number' => fake()->phoneNumber(),
            'zipcode' => fake()->randomElement($zipcode),
            'address1' => fake()->prefecture() . fake()->ward(),
            'address2' => fake()->secondaryAddress(),
            'call_time' => fake()->randomElement($call_time),
            'is_newsletter_subscription' => fake()->randomElement([true, false]),
            'how_did_you_hear' => $userFactory->randomAnket(),
        ];
    }
}
