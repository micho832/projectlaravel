<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=User::class;
    public function definition()
    {
        $gender_id=Gender::pluck('id')->toArray(); //[1,2,3,4,5,6,7,8] //[5,3,2,9]
        $index=array_rand($gender_id);

        $image_id=Image::pluck('id')->toArray(); //[1,2,3,4,5,6,7,8] //[5,3,2,9]
        $index2=array_rand($image_id);
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber(),
            'address' => $this->faker->unique()->address,
            'is_admin' => $this->faker->boolean(),
            'bio'=>$this->faker->sentence(10),
            'password'=>bcrypt('123456'),
            'gender_id'=>$gender_id[$index],
            'image_id'=>$image_id[$index2]

        ];
    }


}
