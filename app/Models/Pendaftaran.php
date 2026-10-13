<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class Pendaftaran extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'nomor_ktp',
        'tempat_lahir',
        'tgl_lahir',
        'nomor_telp',
        'nomor_kk',
        'nama_wali',
        'nomor_ktp_wali',
        'alamat',
        'rtrw',
        'tanggal_pra_medical',
        'pra_medical',
        'file_medical',
        'file_ktp',
        'file_ktp_wali',
        'file_kk',
        'file_akta_lahir',
        'file_surat_nikah',
        'file_surat_ijin',
        'file_ijazah',
        'file_tambahan',
        'data_lengkap',
        'kantor',
        'tujuan',
        'pengalaman',
        'tanggal_pra_bpjs',
        'email_siapkerja',
        'tglsiapkerja',
        'password_siapkerja',
        'tgl_bp2mi',
        'no_id_pmi',
        'file_pp',
        'tanggal_medical_full',
        'tanggal_ec',
        'tanggal_visa',
        'tanggal_bpjs_purna',
        'tanggal_teto',
        'tanggal_pap',
        'tanggal_penerbangan',
        'tanggal_in_toyo',
        'tanggal_in_agency',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'kantor_id',
        'pengalaman_id',
        'sponsor_id',
        'tujuan_id',
    ];

    protected static ?string $recordTitleAttribute = 'nama';

    protected $casts = [
        'tgl_lahir' => 'date',
        'tanggal_pra_medical' => 'date',
        'data_lengkap' => 'boolean',
    ];

    // Relasi ke Province
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    // Relasi ke Regency
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    // Relasi ke District
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    // Relasi ke Village
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    // Relasi ke ProsesCpmi
    public function prosesCpmi(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProsesCpmi::class);
    }

    // Relasi ke Kantor
    public function kantor(): BelongsTo
    {
        return $this->belongsTo(Kantor::class);
    }

    // Relasi ke Sponsor
    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class);
    }

    // Relasi ke Tujuan
    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(Tujuan::class);
    }

    // Relasi ke Pengalaman
    public function pengalaman(): BelongsTo
    {
        return $this->belongsTo(Pengalaman::class);
    }

    // Relasi ke Marketing
    public function marketing(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Marketing::class);
    }

    // Mendapatkan usia dari tgl_lahir
    public function getAgeAttribute()
    {
        if ($this->tgl_lahir) {
            $dateOfBirth = Carbon::parse($this->tgl_lahir);
            return $dateOfBirth->age;
        }
        return 'N/A';
    }

    public function formatAuditFieldsForPresentation($field, Audit $record)
    {
        $fields = Arr::wrap($record->{$field});

        $formattedResult = '<ul>';

        foreach ($fields as $key => $value) {
            $formattedResult .= '<li>';
            $formattedResult .= match ($key) {
                'user_id' => '<strong>User</strong> : ' . User::find($record->{$field}['user_id'])?->name . '<br />',
                'kantor_id' =>  '<strong>KANTOR</strong> : ' . Kantor::find($value)?->nama . '<br />',
                'sponsor_id' =>  '<strong>SPONSOR-PL</strong> : ' . Sponsor::find($value)?->nama . '<br />',
                'pengalaman_id' =>  '<strong>PENGALAMAN</strong> : ' . Pengalaman::find($value)?->nama . '<br />',

                    // 'tanggal_pra_bpjs' => '<strong>PRA BPJS</strong> : ' . $record->{$field}['tanggal_pra_bpjs'] . '<br />',


                default => ' - ',
            };
            $formattedResult .= '</li>';
        }

        $formattedResult .= '</ul>';

        return new HtmlString($formattedResult);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
