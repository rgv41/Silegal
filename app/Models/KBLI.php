<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBLI extends Model
{
    use HasFactory;

    protected $table = 'kbli';

    protected $fillable = [
        'kode_kbli',
        'deskripsi_kbli',
        'kbli_category_id',
    ];
    // Relasi ke kategori KBLI
    public function category()
    {
        return $this->belongsTo(KBLICategory::class, 'kbli_category_id');
    }
    public function formPTBiasa()
    {
        return $this->belongsToMany(FormPTBiasa::class, 'form_pt_biasa_kbli', 'kbli_id', 'form_pt_biasa_id');
    }
    public function formCV()
    {
        return $this->belongsToMany(FormCV::class, 'form_cv_kbli', 'kbli_id', 'form_cv_id');
    }
    public function formPTPerorangan()
    {
        return $this->belongsToMany(FormPTPerorangan::class, 'form_pt_perorangan_kbli', 'kbli_id', 'form_pt_perorangan_id');
    }
    public function formFirma()
    {
        return $this->belongsToMany(FormFirma::class, 'form_firma_kbli', 'kbli_id', 'firma_id');
    }
    public function formYayasan()
    {
        return $this->belongsToMany(FormYayasan::class, 'form_yayasan_kbli', 'kbli_id', 'form_yayasan_id');
    }
}
