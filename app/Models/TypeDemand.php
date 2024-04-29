<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDemand extends Model
{
    use HasFactory;
    protected $table = 'type_demands';

    public function demands(){
        return $this->hasMany('Models\Demand');
    }
}
