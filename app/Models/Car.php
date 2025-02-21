<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Part;
use Exception;

class Car extends Model
{
    /*
        Car - name, registration_number, is_registered
    */
    use HasFactory;
    protected $fillable = ['name', 'registration_number', 'is_registered'];
    
    public function parts(): HasMany {
        return $this->hasMany(Part::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Car $car) {
            if ($car->is_registered && !$car->registration_number) {
                throw new Exception("Registracne cislo musi byt vyplnene!!");
            }
        });
    }
}