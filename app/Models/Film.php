<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ["name", "poster", "status", "genre"];

    public static function count(): int
    {
        return self::all()->count();
    }

    public function getCount(): int {
        return count(self::all());
    }

    public static function remove($name) {
        if(self::contains($name)) {
            self::get($name)->delete();
            return true;

        }
        return false;
    }

    public static function contains($name): bool
    {
        foreach (self::all() as $genre) {
            if($genre->name == $name) {
                return true;
            }
        }

        return false;
    }

    public static function get($name)
    {
        foreach (self::all() as $genre) {
            if($genre->id == $name) {
                return $genre;
            }
        }

        return null;
    }
    
}
