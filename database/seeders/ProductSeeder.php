<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run() {

        $arduino = new Product();
        $arduino->name = "Arduino UNO";
        $arduino->description = "Microcontrolador para monitorizar temperatura. Perfecto para novatos";
        $arduino->price = 20.0;
        $arduino->stock = 100;
        $arduino->save();

        $raspberry = new Product();
        $raspberry->name = "Raspberry Pi 4";
        $raspberry->description = "Mini-ordenador de placa reducida de bajo coste ";
        $raspberry->price = 45.5;
        $raspberry->stock = 50;
        $raspberry->save();
    }
}
