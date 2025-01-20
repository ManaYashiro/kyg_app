<?php

namespace Database\Factories;

use App\Enums\CarClassEnum;
use App\Models\UserVehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserVehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserVehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return fake()->randomElement([$this->smallCar(), $this->mediumCar(), $this->largeCar()]);
    }

    public function smallCar(): array
    {
        $car1 = array(
            'car_name' => 'Toyota',
            'car_katashiki' => 'Yaris'
        );
        $car2 = array(
            'car_name' => 'Toyota',
            'car_katashiki' => 'Aygo'
        );
        $car3 = array(
            'car_name' => 'Toyota',
            'car_katashiki' => 'Corolla'
        );

        $car = array_merge(fake()->randomElement([$car1, $car2, $car3]), [
            'transport_branch' => fake()->randomElement([1, 2, 3]),
            'classification_no' => "AA",
            'kana' => "AA",
            'serial_no' => 1,
        ]);
        return $car;
    }

    public function mediumCar(): array
    {
        $car1 = array(
            'car_name' => 'Ford',
            'car_katashiki' => 'Mustang GT'
        );
        $car2 = array(
            'car_name' => 'Ford',
            'car_katashiki' => 'Expedition'
        );
        $car3 = array(
            'car_name' => 'Ford',
            'car_katashiki' => 'Super Duty F-250'
        );

        $car = array_merge(fake()->randomElement([$car1, $car2, $car3]), [
            'transport_branch' => fake()->randomElement([1, 2, 3]),
            'classification_no' => "AA",
            'kana' => "AA",
            'serial_no' => 1,
            'car_class' => CarClassEnum::KogataJouyousha->value,
        ]);
        return $car;
    }

    public function largeCar(): array
    {

        $car1 = array(
            'car_name' => 'Isuzu',
            'car_katashiki' => 'MU-X'
        );
        $car2 = array(
            'car_name' => 'Isuzu',
            'car_katashiki' => 'Trooper'
        );
        $car3 = array(
            'car_name' => 'Isuzu',
            'car_katashiki' => 'D-Max'
        );

        $car = array_merge(fake()->randomElement([$car1, $car2, $car3]), [
            'transport_branch' => fake()->randomElement([1, 2, 3]),
            'classification_no' => "AA",
            'kana' => "AA",
            'serial_no' => 1,
            'car_class' => CarClassEnum::OogataJouyousha2_5T->value,
        ]);
        return $car;
    }

    public function randomCarNumber(): string
    {
        // ASCII values for A-Z are 65-90
        $letters = chr(rand(65, 90)) . chr(rand(65, 90));

        $digits = rand(1000, 9999);

        return $letters . $digits;
    }
}
