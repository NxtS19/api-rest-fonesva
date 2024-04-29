<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;
    protected  $table = 'demands';

    public function user(){
        return $this->belongsTo('Models\User', 'user_id');
    }

    public function typeDemand(){
        return $this->belongsTo('Models\TypeDemand', 'type_demand_id');
    }
}
