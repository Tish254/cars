<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'id';

    public $timestamps  = true;

    protected $fillable = [
        'name', 'founded', 'description'
    ];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

    public function headquarter()
    {
        return $this->hasOne(Headquarter::class);
    }

    public function engines()
    {
        return $this->hasManyThrough(Engine::class, CarModel::class

        , 'car_id', // Foreign key on CarModel table
        'model_id' // FK on Engine table
    );
    }
}
