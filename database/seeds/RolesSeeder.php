<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles=array(
            array('name'=>'Admin'),
            array('name'=>'Client')
        );
        DB::table('roles')->insert($roles);
    }
}
