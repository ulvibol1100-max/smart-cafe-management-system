<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@smartcafe.test',
        ], [
            'name' => 'Cafe Admin',
            'password' => 'password',
            'is_admin' => true,
        ]);

        User::firstOrCreate([
            'email' => 'staff@smartcafe.test',
        ], [
            'name' => 'Cafe Staff',
            'password' => 'password',
            'is_admin' => false,
        ]);

        $products = collect([
            ['name' => 'Hot Latte', 'price' => 3.50, 'category' => 'Coffee'],
            ['name' => 'Iced Americano', 'price' => 2.75, 'category' => 'Coffee'],
            ['name' => 'Matcha Latte', 'price' => 3.90, 'category' => 'Drink'],
            ['name' => 'Chocolate Frappe', 'price' => 4.25, 'category' => 'Drink'],
            ['name' => 'Croissant', 'price' => 2.40, 'category' => 'Food'],
            ['name' => 'Chicken Sandwich', 'price' => 5.25, 'category' => 'Food'],
        ])->map(fn ($product) => Product::firstOrCreate(['name' => $product['name']], $product));

        $customers = collect([
            ['name' => 'Sokha Lim', 'phone' => '010 123 456', 'loyalty_points' => 8],
            ['name' => 'Dara Chen', 'phone' => '012 987 654', 'loyalty_points' => 14],
        ])->map(fn ($customer) => Customer::firstOrCreate(['phone' => $customer['phone']], $customer));

        Staff::firstOrCreate(['name' => 'Vibol', 'role' => 'Barista'], ['shift' => 'Morning']);
        Staff::firstOrCreate(['name' => 'Malis', 'role' => 'Cashier'], ['shift' => 'Evening']);

        if (! Order::query()->exists()) {
            $order = Order::create([
                'customer_id' => $customers->first()->id,
                'status' => 'completed',
                'total_price' => 0,
            ]);

            $latte = $products->firstWhere('name', 'Hot Latte');
            $croissant = $products->firstWhere('name', 'Croissant');
            $order->products()->attach([
                $latte->id => ['quantity' => 2, 'unit_price' => $latte->price, 'subtotal' => $latte->price * 2],
                $croissant->id => ['quantity' => 1, 'unit_price' => $croissant->price, 'subtotal' => $croissant->price],
            ]);
            $order->update(['total_price' => ($latte->price * 2) + $croissant->price]);
        }
    }
}
