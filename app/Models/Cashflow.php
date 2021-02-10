<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function addSpending($spendings)
    {
        return $this->spendings()->createMany($spendings);
    }
}
