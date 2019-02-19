<?php
use App\Dependence;
use Illuminate\Database\Seeder;
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
