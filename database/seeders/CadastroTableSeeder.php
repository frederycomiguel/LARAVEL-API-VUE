<?php

namespace Database\Seeders;

use App\Models\Cadastro;
use Illuminate\Database\Seeder;

class CadastroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cadastro::factory()->count(20)->create();
    }
}
