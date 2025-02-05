<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Productos de Pokémon
        DB::table('products')->insert([
            [
                'name' => 'Pokébola Clásica',
                'category' => 'TS', // Juguetes
                'price' => 9.99,
                'quantity' => 150,
                'description' => 'Pokébola clásica utilizada para capturar Pokémon.',
                'sku_code' => 'POKEBOLA001',
            ],
            [
                'name' => 'Pikachu Peluche',
                'category' => 'TS', // Juguetes
                'price' => 19.99,
                'quantity' => 50,
                'description' => 'Peluche suave de Pikachu, el Pokémon más popular.',
                'sku_code' => 'PIKACHUPEL001',
            ],
            [
                'name' => 'Charmander Figura',
                'category' => 'TS', // Juguetes
                'price' => 14.99,
                'quantity' => 100,
                'description' => 'Figura de acción de Charmander, el Pokémon de tipo Fuego.',
                'sku_code' => 'CHARMANDERFIG001',
            ],
            [
                'name' => 'Bulto de Pokébolas (Pack de 10)',
                'category' => 'TS', // Juguetes
                'price' => 89.99,
                'quantity' => 30,
                'description' => 'Pack de 10 Pokébolas clásicas, ideales para tus aventuras.',
                'sku_code' => 'POKEBOLAPACK010',
            ],
            [
                'name' => 'Bulbasaur Plush',
                'category' => 'TS', // Juguetes
                'price' => 18.50,
                'quantity' => 70,
                'description' => 'Peluche de Bulbasaur, el Pokémon de tipo Planta/Veneno.',
                'sku_code' => 'BULBASAURPLUSH001',
            ],
            [
                'name' => 'Master Ball',
                'category' => 'TS', // Juguetes
                'price' => 49.99,
                'quantity' => 20,
                'description' => 'Pokébola especial que garantiza la captura de cualquier Pokémon.',
                'sku_code' => 'MASTERBALL001',
            ],
            [
                'name' => 'Evolución de Eevee (Set de Figuras)',
                'category' => 'TS', // Juguetes
                'price' => 39.99,
                'quantity' => 60,
                'description' => 'Set de figuras de las evoluciones de Eevee.',
                'sku_code' => 'EEVEEEVOLSET001',
            ],
            [
                'name' => 'Sudadera Pikachu',
                'category' => 'CL', // Ropa
                'price' => 29.99,
                'quantity' => 40,
                'description' => 'Sudadera con capucha y estampado de Pikachu.',
                'sku_code' => 'SUDADERAPIKA001',
            ],
            [
                'name' => 'Taza Bulbasaur',
                'category' => 'AC', // Accesorios
                'price' => 12.50,
                'quantity' => 120,
                'description' => 'Taza de cerámica con diseño de Bulbasaur.',
                'sku_code' => 'TAZABULBA001',
            ],
            [
                'name' => 'Cartera Charmander',
                'category' => 'AC', // Accesorios
                'price' => 19.99,
                'quantity' => 80,
                'description' => 'Cartera de cuero con diseño de Charmander.',
                'sku_code' => 'CARTERACHAR001',
            ],
        ]);
    }
}
