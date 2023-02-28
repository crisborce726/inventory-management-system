<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'address',
        'birth_day',
    ];

    public function patients()
    {
        return $this->hasMnay(Transaction::class);
    }
}