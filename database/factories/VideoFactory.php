<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_id' => Channel::factory()->create()->id,
            'views' => $this->faker->numberBetween(1, 1000),
            'thumbnail' => $this->faker->imageUrl(),
            'percentage' => 100,
            'title' => $this->faker->sentence(),
            'path' => $this->faker->word()
        ];
    }
}
