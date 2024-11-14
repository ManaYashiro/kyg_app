<?php

namespace Database\Factories;

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
                'furigana' => fake()->name(),
                'role' => User::USER,
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
        return [
            'phone_number' => fake()->phoneNumber(),
            'post_code' => fake()->postcode(),
            'address' => fake()->prefecture() . fake()->ward(),
            'building' => fake()->secondaryAddress(),
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
                'preferred_contact_time' => null,
                'is_newsletter_subscription' => FALSE,
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
                'preferred_contact_time' => '9-12',
                'is_newsletter_subscription' => FALSE,
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
            $contact_time = [
                '9-12',
                '12-13',
                '13-15',
                '15-17',
                '17-19',
                'no_preference',
            ];
            return [
                'role' => User::USER,
                'preferred_contact_time' => fake()->randomElement($contact_time),
                'is_newsletter_subscription' => fake()->randomElement([true, false]),
            ];
        });
    }
}
