<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $tools = [
        //     ['name' => 'Hammer', 'price' => 19.99, 'color' => 'Red'],
        //     ['name' => 'Screwdriver', 'price' => 9.99, 'color' => 'Blue'],
        //     ['name' => 'Wrench', 'price' => 14.99, 'color' => 'Green'],
        // ];

        // foreach ($tools as $tool) {
        //     DB::table('tools')->insert($tool);
        // }
        $tool_name = ['Martello', 'Cacciavite', 'Chiave inglese', 'Trapano', 'Sega', 'Pinza', 'Scalpello', 'Livella', 'Metro', 'Taglierino'];
        $tool_color = ['Rosso', 'Blu', 'Verde', 'Giallo', 'Nero', 'Bianco', 'Arancione', 'Viola', 'Grigio', 'Marrone'];
        for ($i = 0; $i < 5; $i++)    {
            
            DB::table('tools')->insert([
                'name' => $tool_name[array_rand($tool_name)],
                'price' => rand(5, 100) + (rand(0, 99) / 100), // prezzo casuale con decimali
                'color' => $tool_color[array_rand($tool_color)],
            ]);
        }
    }
}

//creato con php artisan make:seeder ToolSeeder
//per popolare il database usare il comando php artisan db:seed ToolSeeder
//oppure fare una call in DatabaseSeeder e poi usare il comando php artisan db:seed
//il seed serve per creare velocemente dei valori di prova