<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    public function run()
    {
        $canalCanteras = new Channel();
        $canalCanteras->id_user = 1;
        $canalCanteras->channel_name = "Sensor las canteras";

    }
}
