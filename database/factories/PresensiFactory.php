<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Presensi;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresensiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Presensi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, User::count()),
            'tanggal' => $this->faker->date(),
            'jam_masuk' => $this->faker->dateTimeThisMonth(),
            'jam_keluar' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
