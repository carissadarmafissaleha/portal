<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function Pendaftaran(): HasMany
    {
        return $this->pendaftarans();
    }

    public function prosesCpmis(): HasMany
    {
        return $this->hasMany(ProsesCpmi::class);
    }

    public function ProsesCpmi(): HasMany
    {
        return $this->prosesCpmis();
    }

    public function marketings(): HasMany
    {
        return $this->hasMany(Marketing::class);
    }

    public function Marketing(): HasMany
    {
        return $this->marketings();
    }
}

