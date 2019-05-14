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
        ]);
        $this->call(InstituteTableSeeder::class);
        $this->call(DependenciesTableSeeder::class);*/
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
