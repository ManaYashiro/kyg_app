<?php

namespace Database\Seeders;

use App\Enums\CallTimeEnum;
use App\Enums\PrefectureEnum;
use App\Models\User;
use App\Models\UserVehicle;
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

        $user = User::factory()->user()->create(
            [
                'loginid' => '0000000002',
                'name' => 'user',
                'name_furigana' => 'user',
                'email' => 'user@user.user',
                'password' => 'p@ssword1234',
                'email_verified_at' => Carbon::now(),
            ]
        );
        $this->generateFakeUserVehicle($user->id);

        $users = User::factory(100)->randomUser()->create();
        foreach ($users as $key => $user) {
            $this->generateFakeUserVehicle($user->id);
        }
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
        $startPhone = ['070', '080', '090'];
        $zipcode = ['5320011', '1000000', '4500001'];
        return (object) [
            'loginid' => '0000000003',
            'name' => 'usera',
            'furigana' => 'usera',
            'email' => 'usera@usera.usera',
            'password' => 'p@ssword1234',
            'phone_number' => fake()->randomElement($startPhone) . fake()->numerify('########'),
            'zipcode' => fake()->randomElement($zipcode),
            'prefecture' => PrefectureEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, PrefectureEnum::cases()))),
            'address1' => fake()->ward(),
            'address2' => fake()->secondaryAddress(),
            'call_time' => CallTimeEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, CallTimeEnum::cases()))),
            'is_newsletter_subscription' => fake()->randomElement([true, false]),
            'how_did_you_hear' => $userFactory->fakeAnket(),
        ];
    }

    public function generateFakeUserVehicle($userId)
    {
        UserVehicle::factory()->create([
            'user_id' => $userId
        ]);
    }
}
