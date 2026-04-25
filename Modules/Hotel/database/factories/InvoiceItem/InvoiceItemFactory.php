<?php

namespace Modules\Hotel\Database\Factories\InvoiceItem;

use Modules\Hotel\Models\InvoiceItem;
use Modules\Hotel\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'description' => $this->faker->sentence(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->randomFloat(2, 20, 500),
            'total_price' => $this->faker->randomFloat(2, 20, 2500),
            'item_type' => $this->faker->randomElement(['room_charge', 'addon', 'tax', 'discount', 'service', 'minibar', 'damage']),
        ];
    }
}
