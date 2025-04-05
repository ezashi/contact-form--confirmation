<?php
namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('###########'),
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->text(120),
        ];
    }
}