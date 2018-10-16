<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'Affiliate';
        $role_employee->code = 'affiliate';
        $role_employee->save();
    
        $role_employee = new Role();
        $role_employee->name = 'Member';
        $role_employee->code = 'member';
        $role_employee->save();
    
        $role_manager = new Role();
        $role_manager->name = 'Admin';
        $role_manager->code = 'admin';
        $role_manager->save();
    }
}
