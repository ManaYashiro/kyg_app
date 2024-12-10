<?php

namespace Database\Factories;

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
            'car1_name' => 'Toyota',
            'car1_katashiki' => 'Yaris'
        );
        $car2 = array(
            'car1_name' => 'Toyota',
            'car1_katashiki' => 'Aygo'
        );
        $car3 = array(
            'car1_name' => 'Toyota',
            'car1_katashiki' => 'Corolla'
        );

        $car = array_merge(fake()->randomElement([$car1, $car2, $car3]), [
            'car1_number' => $this->randomCarNumber(),
            'car1_class' => 1,
        ]);
        return $car;
    }

    public function mediumCar(): array
    {
        $car1 = array(
            'car1_name' => 'Ford',
            'car1_katashiki' => 'Mustang GT'
        );
        $car2 = array(
            'car1_name' => 'Ford',
            'car1_katashiki' => 'Expedition'
        );
        $car3 = array(
            'car1_name' => 'Ford',
            'car1_katashiki' => 'Super Duty F-250'
        );

        $car = array_merge(fake()->randomElement([$car1, $car2, $car3]), [
            'car1_number' => $this->randomCarNumber(),
            'car1_class' => 2,
        ]);
        return $car;
    }

    public function largeCar(): array
    {

        $car1 = array(
            'car1_name' => 'Isuzu',
            'car1_katashiki' => 'MU-X'
        );
        $car2 = array(
            'car1_name' => 'Isuzu',
            'car1_katashiki' => 'Trooper'
        );
        $car3 = array(
            'car1_name' => 'Isuzu',
            'car1_katashiki' => 'D-Max'
        );

        $car = array_merge(fake()->randomElement([$car1, $car2, $car3]), [
            'car1_number' => $this->randomCarNumber(),
            'car1_class' => 5,
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
