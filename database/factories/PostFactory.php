<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        /*asignamos datos falsos para el testing en la bd*/
        return [
            'title'=>$this->faker->sentence(10),
            'description'=>$this->faker->sentence(20),
            'image'=>$this->faker->uuid().'.jpg',
            'user_id'=>$this->faker->randomElement([1,2]),
        ];
    }
}
