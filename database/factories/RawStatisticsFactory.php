<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\RawStatistics;
use Illuminate\Database\Eloquent\Factories\Factory;

class RawStatisticsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RawStatistics::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'data' => [],
        ];
    }
}
