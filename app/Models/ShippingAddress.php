<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $table = 'shipping_address';

    protected $fillable = [
        'form_cv_id',
        'form_pt_biasa_id',
        'form_pt_perorangan_id',
        'form_firma_id',
        'form_yayasan_id',
        'address',
    ];

    // Relasi dengan form_cv
    public function formCV()
    {
        return $this->belongsTo(FormCV::class);
    }

    // Relasi dengan form_pt_biasa
    public function formPTBiasa()
    {
        return $this->belongsTo(FormPTBiasa::class);
    }

    // Relasi dengan form_pt_perorangan
    public function formPTPerorangan()
    {
        return $this->belongsTo(FormPTPerorangan::class);
    }

    // Relasi dengan form_firma
    public function formFirma()
    {
        return $this->belongsTo(FormFirma::class);
    }

    // Relasi dengan form_yayasan
    public function formYayasan()
    {
        return $this->belongsTo(FormYayasan::class);
    }
}
