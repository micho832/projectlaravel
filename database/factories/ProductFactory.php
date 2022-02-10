<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Product::class;
    public function definition()
    {
        $category_id=Category::pluck('id')->toArray(); //[1,2,3,4,5,6,7,8] //[5,3,2,9]
        $index=array_rand($category_id);

        $imageIds=Image::pluck('id')->toArray();
        $index2=array_rand($imageIds);
        return [
            'name'=>$this->faker->text(10),
            'description'=>$this->faker->sentence(30),
            'selling_price'=>$this->faker->randomFloat(2,0,9999),
            'buying_price'=>$this->faker->randomFloat(2,0,9999),
            'discount'=>$this->faker->randomFloat(2,0,100),
            'is_available'=>$this->faker->boolean(),
            'is_new'=>$this->faker->boolean(),
            'is_upcoming'=>$this->faker->boolean(),
            'quantity'=>$this->faker->randomNumber(4),
            'category_id'=>$category_id[$index],
            'image_id'=>$imageIds[$index2],

        ];
    }
}
