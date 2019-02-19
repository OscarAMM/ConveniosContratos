<?php

use Illuminate\Database\Seeder;
use App\Dependence;
class DependenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Dependence::class,5)->create();
    }
}
