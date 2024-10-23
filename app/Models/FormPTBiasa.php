<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPTBiasa extends Model
{
    use HasFactory;

    protected $table = 'form_pt_biasa';

    protected $fillable = [
        'nama_pt',
        'modal_dasar',
        'modal_setor',
        'nilai_nominal_per_saham',
        'pemegang_saham_pertama_persen',
        'pemegang_saham_kedua_persen',
        'direktur_nama',
        'direktur_email',
        'direktur_telp',
        'komisaris_nama',
        'komisaris_email',
        'komisaris_telp',
        'no_telp_kantor',
        'email_kantor',
        'bidang_usaha',
        'alamat_pt',
        'foto_ktp',
        'foto_npwp',
        'password',
    ];

    public function kbli()
    {
        return $this->belongsToMany(KBLI::class, 'form_pt_biasa_kbli', 'form_pt_biasa_id', 'kbli_id');
    }
}
