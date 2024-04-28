<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningItem extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'section', 'value'];

    protected $casts = [
        'date' => 'date',
    ];

}
