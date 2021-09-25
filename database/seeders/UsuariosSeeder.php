<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([

            'name'=> 'admin',
            'email'=> 'slayercorp2017@gmail.com',
            'password'=> Hash::make('12345678'),
            'url'=>'https://laravel.com/',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        $user=User::create([

            'name'=> 'admin1',
            'email'=> 'diegorcc380@gmail.com',
            'password'=> Hash::make('12345678'),
            'url'=>'https://laravel.com/',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

       
    }
}
