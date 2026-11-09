<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::where('role', 'client')->first();
        $variation = ProductVariation::with('product')->first();

        if (!$client || !$variation) return;

        $statuses = ['pending', 'paid', 'shipped', 'delivered', 'canceled'];

        foreach ($statuses as $status) {
            $order = Order::create([
                'user_id'       => $client->id,
                'status'        => $status,
                'shipping_cost' => 0.00,
                'total'         => $variation->price * 2,
                'paid_at'       => in_array($status, ['paid', 'shipped', 'delivered']) ? now() : null,
            ]);

            OrderItem::create([
                'order_id'              => $order->id,
                'variation_id'         => $variation->id,
                'product_name'          => $variation->product->name ?? 'Capacete LS2 FF358',
                'variation_description' => $variation->color . ' - Tam ' . $variation->size,
                'quantity'              => 2,
                'unit_price'            => $variation->price,
            ]);
        }
    }
}