<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class ProsesCpmi extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pelatihan_id',
        'pendaftaran_id',
        'tanggal_pra_bpjs',
        'tanggal_ujk',
        'tglsiapkerja',
        'email_siapkerja',
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
        'file_medical_full',
        'file_ec',
        'file_visa',
        'file_bpjs_purna',
        'file_teto',
        'file_pap',
        'file_penerbangan',
        'file_in_toyo',
        'file_in_agency',
        'status_id',
        'tujuan_id',
        'tunggu_id',
    ];

    protected $casts = [
        'tanggal_pra_bpjs' => 'date',
        'tanggal_ujk' => 'date',
        'tglsiapkerja' => 'date',
        'tgl_bp2mi' => 'date',
        'tanggal_medical_full' => 'date',
        'tanggal_ec' => 'date',
        'tanggal_visa' => 'date',
        'tanggal_bpjs_purna' => 'date',
        'tanggal_teto' => 'date',
        'tanggal_pap' => 'date',
        'tanggal_penerbangan' => 'date',
        'tanggal_in_toyo' => 'date',
        'tanggal_in_agency' => 'date',
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    // Relasi ke Tujuan
    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(Tujuan::class);
    }

    // Relasi ke Tunggu
    public function tunggu(): BelongsTo
    {
        return $this->belongsTo(Tunggu::class);
    }

    // Relasi ke Status
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Relasi ke Pelatihan
    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class);
    }

    // Relasi ke Marketing
    public function marketing(): HasOne
    {
        return $this->hasOne(Marketing::class, 'proses_cpmi_id');
    }

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formatAuditFieldsForPresentation($field, Audit $record)
    {
        $fields = Arr::wrap($record->{$field});

        $formattedResult = '<ul>';

        foreach ($fields as $key => $value) {
            $formattedResult .= '<li>';
            $formattedResult .= match ($key) {
                'user_id' => '<strong>User</strong> : ' . User::find($record->{$field}['user_id'])?->name . '<br />',
                'status_id' =>  '<strong>STATUS</strong> : ' . Status::find($value)?->nama . '<br />', // Menampilkan nama status
                'tujuan_id' =>  '<strong>TUJUAN</strong> : ' . Tujuan::find($value)?->nama . '<br />', // Menampilkan nama tujuan
                'tanggal_pra_bpjs' => '<strong>PRA BPJS</strong> : ' . $record->{$field}['tanggal_pra_bpjs'] . '<br />',
                'tanggal_ujk' => '<strong>UJK</strong> : ' . $record->{$field}['tanggal_ujk'] . '<br />',
                'tglsiapkerja' => '<strong>Tgl Siap Kerja</strong> : ' . $record->{$field}['tglsiapkerja'] . '<br />',
                'email_siapkerja' => '<strong>Email Siap Kerja</strong> : ' . $record->{$field}['email_siapkerja'] . '<br />',
                'password_siapkerja' => '<strong>Password Siap Kerja</strong> : ' . $record->{$field}['password_siapkerja'] . '<br />',
                'tgl_bp2mi' => '<strong>BP2MI</strong> : ' . $record->{$field}['tgl_bp2mi'] . '<br />',
                'no_id_pmi' => '<strong>ID PMI</strong> : ' . $record->{$field}['no_id_pmi'] . '<br />',
                'file_pp' => '<strong>File PP</strong> : ' . $record->{$field}['file_pp'] . '<br />',
                'tanggal_medical_full' => '<strong>Medical Full</strong> : ' . $record->{$field}['tanggal_medical_full'] . '<br />',
                'tanggal_ec' => '<strong>EC</strong> : ' . $record->{$field}['tanggal_ec'] . '<br />',
                'tanggal_visa' => '<strong>Visa</strong> : ' . $record->{$field}['tanggal_visa'] . '<br />',
                'tanggal_bpjs_purna' => '<strong>BPJS Purna</strong> : ' . $record->{$field}['tanggal_bpjs_purna'] . '<br />',
                'tanggal_teto' => '<strong>TETO</strong> : ' . $record->{$field}['tanggal_teto'] . '<br />',
                'tanggal_pap' => '<strong>PAP</strong> : ' . $record->{$field}['tanggal_pap'] . '<br />',
                'tanggal_penerbangan' => '<strong>Penerbangan</strong> : ' . $record->{$field}['tanggal_penerbangan'] . '<br />',
                'tanggal_in_toyo' => '<strong>In Toyo</strong> : ' . $record->{$field}['tanggal_in_toyo'] . '<br />',
                'tanggal_in_agency' => '<strong>In Agency</strong> : ' . $record->{$field}['tanggal_in_agency'] . '<br />',
                'file_medical_full' => '<strong>File Medical Full</strong> : ' . $record->{$field}['file_medical_full'] . '<br />',
                'file_ec' => '<strong>File EC</strong> : ' . $record->{$field}['file_ec'] . '<br />',
                'file_visa' => '<strong>File Visa</strong> : ' . $record->{$field}['file_visa'] . '<br />',
                'file_bpjs_purna' => '<strong>File BPJS Purna</strong> : ' . $record->{$field}['file_bpjs_purna'] . '<br />',
                'file_teto' => '<strong>File TETO</strong> : ' . $record->{$field}['file_teto'] . '<br />',
                'file_pap' => '<strong>File PAP</strong> : ' . $record->{$field}['file_pap'] . '<br />',
                'file_penerbangan' => '<strong>File Penerbangan</strong> : ' . $record->{$field}['file_penerbangan'] . '<br />',
                'file_in_toyo' => '<strong>File In Toyo</strong> : ' . $record->{$field}['file_in_toyo'] . '<br />',
                'file_in_agency' => '<strong>File In Agency</strong> : ' . $record->{$field}['file_in_agency'] . '<br />',


                default => ' - ',
            };
            $formattedResult .= '</li>';
        }

        $formattedResult .= '</ul>';

        return new HtmlString($formattedResult);
    }

}
