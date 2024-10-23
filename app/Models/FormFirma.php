<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFirma extends Model
{
    use HasFactory;

    protected $table = 'form_firma';

    protected $fillable = [
        'nama_firma',
        'modal',
        'managing_partner',
        'no_telp_kantor',
        'email_kantor',
        'managing_partner_telp',
        'managing_partner_email',
        'partner_telp',
        'partner_email',
        'alamat_firma',
        'foto_ktp',
        'foto_npwp',
        'password',
    ];

    public function kbli()
    {
        return $this->belongsToMany(KBLI::class, 'form_firma_kbli', 'firma_id', 'kbli_id');
    }
}
