<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Spending extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cashflow()
    {
        return $this->belongsTo(Cashflow::class);
    }
}
