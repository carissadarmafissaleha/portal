<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'penanggungjawab',
        'nomortelp',
        'alamat',
    ];

    public function marketings(): HasMany
    {
        return $this->hasMany(Marketing::class);
    }

    public function Marketing(): HasMany
    {
        return $this->marketings();
    }
}

