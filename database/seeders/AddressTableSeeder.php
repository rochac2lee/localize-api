<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Endereço default para testes
        $address = [
            'cep' => 82510190,
            'uf' => "PR",
            'cidade' => "Curitiba",
            'bairro' => "Bacacheri",
            'endereco' => "Rua Holanda",
            'numero' => 202,
            'complemento' => "Agência dos Correios"
        ];

        DB::table('addresses')->insert($address);
    }
}
