<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orderIds=Order::pluck('id')->toArray();
        $index=array_rand($orderIds);

        $productIds=Product::pluck('id')->toArray();
        $index2=array_rand($productIds);
        return [
           'order_id'=>$orderIds[$index],
           'product_id'=>$productIds[$index2],
           'amount'=>$this->faker->randomNumber(),
           'price'=>$this->faker->randomFloat(2,20,1000),
           'discount'=>$this->faker->randomFloat(2,0,100),
        ];
    }
}
