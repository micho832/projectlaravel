<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds=User::pluck('id')->toArray();
        $index=array_rand($userIds);
        return [
           'user_id'=>$userIds[$index],
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'phone'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'discount'=>$this->faker->randomFloat(2,0,100),
            'tax'=>$this->faker->randomFloat(2,0,1000),
            'is_received'=>$this->faker->boolean,
            'shipped_at'=>$this->faker->dateTime,
            'is_checked_out'=>true
        ];
    }
}
