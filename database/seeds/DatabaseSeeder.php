<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadosRepublicaCatalogTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(TransportistaTableSeeder::class);
        $this->call(TiposDeUsuarioTableSeeder::class);
        $this->call(ClienteTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TiposDeCargaTableSeeder::class);
        $this->call(TiposDeGastoTableSeeder::class);
        $this->call(TiposDeIncidenciaTableSeeder::class);
        $this->call(RepresentanteClienteTableSeeder::class);
        $this->call(TemporadaTableSeeder::class);
        $this->call(UnidadesTableSeeder::class);
        $this->call(TiposDeMantenimientoTableSeeder::class);
        $this->call(EquipoCelularTableSeeder::class);
        $this->call(TiposDeEstablecimientoTableSeeder::class);
        $this->call(EstablecimientosCatalogTableSeeder::class);
        $this->call(JefeDeSectorTableSeeder::class);
        $this->call(TrenTableSeeder::class);
        $this->call(ViajeTableSeeder::class);
        $this->call(TiroTableSeeder::class);

    }
}
