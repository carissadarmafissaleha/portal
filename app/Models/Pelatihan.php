<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelatihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'penanggungjawab',
        'nomortelp',
        'alamat',
    ];

    public function prosesCpmis(): HasMany
    {
        return $this->hasMany(ProsesCpmi::class);
    }

    public function ProsesCpmi(): HasMany
    {
        return $this->prosesCpmis();
    }
}

