<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPTPerorangan extends Model
{
    use HasFactory;

    protected $table = 'form_pt_perorangan';

    protected $fillable = [
        'nama_pt',
        'no_telp',
        'alamat_pt',
        'foto_ktp',
        'foto_npwp',
        'modal_usaha',
        'password',
    ];
    public function kbli()
    {
        return $this->belongsToMany(KBLI::class, 'form_pt_perorangan_kbli', 'form_pt_perorangan_id', 'kbli_id');
    }
}
