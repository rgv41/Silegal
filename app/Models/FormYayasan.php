<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormYayasan extends Model
{
    use HasFactory;

    protected $table = 'form_yayasan';

    protected $fillable = [
        'nama_yayasan',
        'modal',
        'pendiri',
        'pembina',
        'no_hp_pembina',
        'email_pembina',
        'ketua_pengurus',
        'no_hp_ketua_pengurus',
        'email_ketua_pengurus',
        'sekretaris',
        'no_hp_sekretaris',
        'email_sekretaris',
        'bendahara',
        'no_hp_bendahara',
        'email_bendahara',
        'pengawas',
        'no_hp_pengawas',
        'email_pengawas',
        'alamat_lengkap',
        'rt_rw',
        'kode_pos',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'no_telp_hk_kantor',
        'email_kantor',
        'bidang_yayasan',
        'foto_ktp',
        'foto_npwp',
        'password',
    ];
    public function kbli()
    {
        return $this->belongsToMany(KBLI::class, 'form_yayasan_kbli', 'form_yayasan_id', 'kbli_id');
    }
}
