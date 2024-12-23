<?php

namespace Database\Factories;

use App\Enums\CallTimeEnum;
use App\Enums\GenderEnum;
use App\Enums\IsNewsletterEnum;
use App\Enums\IsNotificationEnum;
use App\Enums\PrefectureEnum;
use App\Models\Anket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $isAdmin = $attributes['role'] = User::ADMIN ? true : false;

        return
            array_merge($this->otherData($isAdmin), [
                'name' => fake()->name(),
                'name_furigana' => fake()->name(),
                'role' => User::USER,
                'loginid' => fake()->regexify('[a-z0-9]{10}'),
                'email' => fake()->unique()->safeEmail(),
                'password' => 'p@ssword1234',
            ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function otherData(bool $isAdmin = false): array
    {
        $startPhone = ['070', '080', '090'];
        $zipcode = ['5320011', '1000000', '4500001'];
        return [
            'phone_number' => fake()->randomElement($startPhone) . fake()->numerify('########'),
            'zipcode' => fake()->randomElement($zipcode),
            'prefecture' => PrefectureEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, PrefectureEnum::cases()))),
            'address1' => fake()->ward(),
            'address2' => fake()->secondaryAddress(),
            'gender' => fake()->randomElement([GenderEnum::Male, GenderEnum::Female]), // 男性・女性
            'birthday' => fake()->dateTimeBetween('1990-01-01', '2000-12-31'),
        ];
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => User::ADMIN,
                'call_time' => null,
                'is_receive_newsletter' => IsNewsletterEnum::No,
                'is_receive_notification' => IsNotificationEnum::No,
            ];
        });
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function user()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => User::USER,
                'call_time' => CallTimeEnum::A_09_12,
                'questionnaire' => [1, 2, 3],
                'is_receive_newsletter' => IsNewsletterEnum::No,
                'is_receive_notification' => IsNotificationEnum::No,
            ];
        });
    }

    /**
     * Indicate that the user is a regular user.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function randomUser()
    {
        return $this->state(function (array $attributes) {
            $call_time = CallTimeEnum::cases();
            return [
                'role' => User::USER,
                'call_time' => fake()->randomElement($call_time),
                'questionnaire' => $this->fakeAnket(),
                'is_receive_newsletter' => fake()->randomElement([IsNewsletterEnum::No, IsNewsletterEnum::Yes]),
                'is_receive_notification' => fake()->randomElement([IsNotificationEnum::No, IsNotificationEnum::Yes]),
            ];
        });
    }

    public function fakeAnket(): array
    {

        $questionnaire = Anket::get()->pluck('id')->toArray();

        // Get a random quantity from 0 to 3
        $quantity = rand(1, 3);

        // Shuffle the array to randomize the order
        shuffle($questionnaire);

        // Slice the array to get the desired quantity
        return array_slice($questionnaire, 0, $quantity);
    }
}
