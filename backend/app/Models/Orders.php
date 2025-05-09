<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'prize',
        'count',
        'type',
        'status',
        'item_id',
        'costumer_id'
    ];
}
