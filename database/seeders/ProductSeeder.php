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

        $esp82 = new Product();
        $esp82->name = "ESP8266";
        $esp82->description = "Sensor de poca potencia. Perfecto para sensores pequeños ";
        $esp82->price = 40;
        $esp82->stock = 70;
        $esp82->save();

        $waspmote = new Product();
        $waspmote->name = "Waspmote";
        $waspmote->description = "Placa para ZigBee para SmartCities ";
        $waspmote->price = 45.5;
        $waspmote->stock = 50;
        $waspmote->save();
    }
}
