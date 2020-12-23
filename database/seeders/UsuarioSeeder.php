<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class UsuarioSeeder extends Seeder
{
    public function run()
    {

        $adminUser = new Usuario();
        $adminUser->name = "admin";
        $adminUser->email = "admin@admin.com";
        $adminUser->password = md5("11");
        $adminUser->birthday = '2018-12-05 12:39:16';
        $adminUser->save();

        $rubenUser = new Usuario();
        $rubenUser->name = "ruben";
        $rubenUser->email = "ruben@gmail.com";
        $rubenUser->password = md5("11");
        $rubenUser->birthday = '2018-12-05 12:39:16';
        $rubenUser->save();

        $testUser = new Usuario();
        $testUser->name = "test";
        $testUser->email = "test@gmail.com";
        $testUser->password = md5("11");
        $testUser->birthday = '2018-12-05 12:39:16';
        $testUser->save();

    }
}
