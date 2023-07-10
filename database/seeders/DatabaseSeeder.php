<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            'name' => "Хоррор",
        ]);
        DB::table('genres')->insert([
            'name' => "Фентези",
        ]);
        
        DB::table('films')->insert([
            'name' => "ОНО",
            "status" => 0,
            "genre" => 1,
            "poster" => "ono.jpg"
        ]);
        DB::table('films')->insert([
            'name' => "Аватар 4",
            "status" => 1,
            "genre" => 2,
            "poster" => "avatar.jpg"
        ]);
    }
}
