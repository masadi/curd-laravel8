<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$usersTable = (new User)->getTable();
        //DB::table($usersTable)->truncate();
        DB::table('users')->delete();
        $user = User::create([
            'name' => 'Adminsitrator',
            'email' => 'admin@app.com',
            'password' => bcrypt('password')
        ]);
        $role = Role::where('name', 'administrator')->first();
        $user->attachRole($role);
    }
}
