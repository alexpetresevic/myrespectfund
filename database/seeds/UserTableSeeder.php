<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        
        $adminUser = new User();
        $adminUser->first_name = 'Admin';
        $adminUser->last_name = 'Istrator';
        $adminUser->role_id = $adminRole->id;
        $adminUser->email = 'admin@domain.com';
        $adminUser->password = bcrypt('secret');
        $adminUser->save();
    }
}
