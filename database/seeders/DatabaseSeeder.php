<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'address' => 'Bogalay',
            'email' => 'admin@gmail.com',
            'phone' => '09982764942',
            'role'=>'admin',
            'gender' => 'male',
            'job' => 'Web developer',
            'description'=>'I am web developer.I am 12 years old.',
            'password'=> Hash::make('admin123'),
        ]);

        Group::create([
            'name' => 'Group Name'
        ]);
    }
}
