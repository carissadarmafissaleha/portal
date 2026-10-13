<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel; // Pastikan untuk mengimpor Panel
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements
    HasAvatar,
    FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Semua akun terdaftar yang valid memiliki akses ke panel sesuai role & permission masing-masing
        return true;
    }

    // Relasi dengan Pendaftaran
    public function pendaftarans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }

    // Relasi dengan Proses CPMI
    public function prosesCpmis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProsesCpmi::class);
    }

    public function proses_cpmis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->prosesCpmis();
    }

    // Relasi dengan Marketings
    public function marketings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Marketing::class);
    }
}
