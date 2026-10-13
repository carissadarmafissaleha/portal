<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marketing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'foto',
        'code_hk',
        'code_tw',
        'code_sgp',
        'code_my',
        'nomor_hp',
        'get_job',
        'tgl_job',
        'nama',
        'national',
        'kelamin',
        'lulusan',
        'agama',
        'anakke',
        'brother',
        'sister',
        'usia',
        'tanggal_lahir',
        'status_nikah',
        'tinggi_badan',
        'berat_badan',
        'son',
        'daughter',
        'careofbabies',
        'careoftoddler',
        'careofchildren',
        'careofelderly',
        'careofdisabled',
        'careofbedridden',
        'careofpet',
        'householdworks',
        'carwashing',
        'gardening',
        'cooking',
        'driving',
        'hongkong',
        'singapore',
        'taiwan',
        'malaysia',
        'macau',
        'middleeast',
        'other',
        'homecountry',
        'spokenenglish',
        'spokencantonese',
        'spokenmandarin',
        'remark',
        'pengalaman',
        'babi',
        'liburbukanhariminggu',
        'berbagikamar',
        'takutanjing',
        'merokok',
        'alkohol',
        'pernahsakit',
        'ketsakit',
        'tujuan_id',
        'kantor_id',
        'marketing_id',
        'pengalaman_id',
        'dapatjob',
        'pendaftaran_id',
        'proses_cpmi_id',
        'agency_id',
        'sales_id',
    ];

    protected $casts = [
        'pengalaman' => 'array',
        'get_job' => 'boolean',
        'tgl_job' => 'date',
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }


    // Relasi ke ProsesCpmi
    public function prosesCpmi(): BelongsTo
    {
        return $this->belongsTo(ProsesCpmi::class, 'proses_cpmi_id');
    }

    // Relasi ke Tujuan
    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id');
    }

    // Relasi ke Status (melalui ProsesCpmi atau kolom jika ada)
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Relasi ke Sales
    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    // Relasi ke Sponsor
    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }

    // Relasi ke Agency
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    // Relasi ke Kantor
    public function kantor(): BelongsTo
    {
        return $this->belongsTo(Kantor::class, 'kantor_id');
    }

    // Relasi ke Pengalaman
    public function pengalamans(): BelongsTo
    {
        return $this->belongsTo(Pengalaman::class, 'pengalaman_id');
    }

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shouldBeHidden(): \Filament\Actions\Action
    {
        return \Filament\Actions\Action::make("Done")
            ->color("success")
            ->hidden(fn(ApprovableModel $record) => $record->shouldBeHidden());
    }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}

