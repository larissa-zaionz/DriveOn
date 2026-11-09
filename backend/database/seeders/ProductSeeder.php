<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catFechados     = Category::where('slug', 'capacetes-fechados')->first()->id ?? 1;
        $catEscamoteaveis = Category::where('slug', 'capacetes-escamoteaveis')->first()->id ?? 2;
        $catAbertos      = Category::where('slug', 'capacetes-abertos')->first()->id ?? 3;
        $catAcessorios   = Category::where('slug', 'viseiras-e-acessorios')->first()->id ?? 4;

        $brands = ['LS2', 'AGV', 'Norisk', 'Bell', 'MT Helmets', 'HJC', 'Arai', 'Shoei'];
        $categories = [$catFechados, $catEscamoteaveis, $catAbertos, $catAcessorios];


        for ($i = 1; $i <= 28; $i++) {
            $brand = $brands[$i % count($brands)];
            $catId = $categories[$i % count($categories)];

            $product = Product::create([
                'category_id' => $catId,
                'name'        => "Capacete {$brand} Model-{$i} Pro",
                'description' => "Capacete de alta performance {$brand} modelo {$i} com viseira anti-risco e forro removível.",
                'is_active'   => true,
            ]);

            ProductVariation::create([
                'product_id' => $product->id,
                'sku'        => strtoupper("{$brand}-M{$i}-BLK-58"),
                'size'       => '58',
                'color'      => 'Preto',
                'price'      => 450.00 + ($i * 15),
                'stock'      => 10,
                'is_active'  => true,
            ]);

            ProductVariation::create([
                'product_id' => $product->id,
                'sku'        => strtoupper("{$brand}-M{$i}-WHT-60"),
                'size'       => '60',
                'color'      => 'Branco',
                'price'      => 450.00 + ($i * 15),
                'stock'      => 5,
                'is_active'  => true,
            ]);
        }

        $semEstoque = Product::create([
            'category_id' => $catFechados,
            'name'        => 'Capacete AGV Pista GP RR Special (Esgotado)',
            'description' => 'Edição limitada de alta competição sem estoque disponível.',
            'is_active'   => true,
        ]);

        ProductVariation::create([
            'product_id' => $semEstoque->id,
            'sku'        => 'AGV-PISTA-ESG-58',
            'size'       => '58',
            'color'      => 'Carbono',
            'price'      => 3499.90,
            'stock'      => 0, 
            'is_active'  => true,
        ]);


        $inativo = Product::create([
            'category_id' => $catAbertos,
            'name'        => 'Capacete Retrô Vintage Off (Inativo)',
            'description' => 'Modelo fora de linha não exibido no catálogo.',
            'is_active'   => false, 
        ]);

        ProductVariation::create([
            'product_id' => $inativo->id,
            'sku'        => 'VINT-OFF-OFF-58',
            'size'       => '58',
            'color'      => 'Marrom',
            'price'      => 299.90,
            'stock'      => 8,
            'is_active'  => false,
        ]);
    }
}