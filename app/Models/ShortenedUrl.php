<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortenedUrl extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'shortened_url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->shortened_url = self::generateUniqueShortenedUrl();
        });
    }

    protected static function generateUniqueShortenedUrl()
    {
        $url = Str::random(8); // Generar una cadena aleatoria de 8 caracteres
        // Verificar si el URL ya existe en la base de datos, si es así, generar otro
        while (self::where('shortened_url', $url)->exists()) {
            $url = Str::random(8);
        }
        return $url;
    }



}
