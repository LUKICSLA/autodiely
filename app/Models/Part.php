<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Car;

class Part extends Model {
    /*
        Part - name, serialnumber, car_id
    */
    use HasFactory;

    protected $fillable = ['name', 'serialnumber', 'car_id'];

    public function car() {
        return $this->belongsTo(Car::class);
    }
}