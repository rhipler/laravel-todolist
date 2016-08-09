<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
                ['name' => 'user']
                ]
        );
        $admin = DB::table('roles')->where('name','admin')->first();

        //$this->call(UsersTableSeeder::class);
        factory(Todolist\User::class)->create(['name'=>'admin','email'=>'admin@localhost','password'=>bcrypt('admin'),'role_id'=>$admin->id ]);
    }
}
