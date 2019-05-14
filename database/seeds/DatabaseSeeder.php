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
        /*$this->truncateTables([
            'institutes','dependences',
<<<<<<< HEAD
        ]);*/
       
=======
        ]);
        $this->call(InstituteTableSeeder::class);
        $this->call(DependenciesTableSeeder::class);*/
>>>>>>> 50797cfec7809d5945e24d8c71ac4cc5677023f2
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }

    protected function truncateTables(array $tables){
        DB::Statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($tables as $table){
            DB::table($table)->truncate();
        }
    }
}
