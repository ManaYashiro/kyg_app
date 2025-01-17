<?php

namespace Database\Factories;

use App\Enums\CallTimeEnum;
use App\Enums\GenderEnum;
use App\Enums\IsNewsletterEnum;
use App\Enums\IsNotificationEnum;
use App\Enums\PersonTypeEnum;
use App\Enums\PrefectureEnum;
use App\Enums\QuestionnaireEnum;
use App\Enums\UserRoleEnum;
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

        $isAdmin = $attributes['role'] = UserRoleEnum::Admin->value ? true : false;

        return
            array_merge($this->otherData($isAdmin), [
                'name' => fake()->name(),
                'name_furigana' => fake()->name(),
                'role' => UserRoleEnum::User->value,
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
                'role' => UserRoleEnum::Admin->value,
                'call_time' => null,
                'is_receive_newsletter' => IsNewsletterEnum::No->value,
                'is_receive_notification' => IsNotificationEnum::No->value,
                'gender' => GenderEnum::Male->value,
                'birthday' => '1990-01-01',
                'person_type' => PersonTypeEnum::Private->value,
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
                'role' => UserRoleEnum::User->value,
                'call_time' => CallTimeEnum::A_09_12->value,
                'questionnaire' => $this->fakeQuestionnaire(),
                'is_receive_newsletter' => IsNewsletterEnum::No->value,
                'is_receive_notification' => IsNotificationEnum::No->value,
                'gender' => GenderEnum::Male->value,
                'birthday' => '1990-01-01',
                'person_type' => PersonTypeEnum::Private->value,
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
            return [
                'role' => UserRoleEnum::User->value,
                'gender' => GenderEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, GenderEnum::cases()))),
                'birthday' => fake()->dateTimeBetween('1990-01-01', '2000-12-31'),
                'call_time' => CallTimeEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, CallTimeEnum::cases()))),
                'questionnaire' => $this->fakeQuestionnaire(),
                'person_type' => PersonTypeEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, PersonTypeEnum::cases()))),
                'is_receive_newsletter' => IsNewsletterEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, IsNewsletterEnum::cases()))),
                'is_receive_notification' => IsNotificationEnum::from(fake()->randomElement(array_map(fn($case) => $case->value, IsNotificationEnum::cases()))),
            ];
        });
    }

    public function fakeQuestionnaire(): array
    {
        return collect(QuestionnaireEnum::cases())
            ->map(fn($case) => $case->value)
            ->random(rand(1, 3))->toArray();
    }
}
