<?php

use Illuminate\Database\Seeder;
use App\Institute;
class InstituteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Institute::class,10)->create();
    }
}