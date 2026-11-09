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
        $variation = ProductVariation::first();

        if (!$client || !$variation) return;

        $statuses = ['aguardando_pagamento', 'pago', 'enviado', 'entregue', 'cancelado'];

        foreach ($statuses as $status) {
            $order = Order::create([
                'user_id'      => $client->id,
                'status'       => $status,
                'total_amount' => $variation->price * 2,
            ]);

            OrderItem::create([
                'order_id'             => $order->id,
                'product_variation_id' => $variation->id,
                'price'                => $variation->price,
                'quantity'             => 2,
            ]);
        }
    }
}