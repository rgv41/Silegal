<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormCV extends Model
{
    use HasFactory;

    protected $table = 'form_cv';

    protected $fillable = [
        'nama_cv',
        'modal_cv',
        'pemegang_saham_pertama',
        'pemegang_saham_kedua',
        'direktur',
        'no_telp_direktur',
        'email_direktur',
        'komisaris',
        'no_telp_komisaris',
        'email_komisaris',
        'no_telp_kantor',
        'email_kantor',
        'bidang_usaha',
        'alamat_cv',
        'foto_ktp',
        'foto_npwp',
        'password',
    ];
    public function kbli()
    {
        return $this->belongsToMany(KBLI::class, 'form_cv_kbli', 'form_cv_id', 'kbli_id');
    }
}
