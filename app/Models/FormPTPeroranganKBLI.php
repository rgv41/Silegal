<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPTPeroranganKBLI extends Model
{
    use HasFactory;

    protected $table = 'form_pt_perorangan_kbli';

    protected $fillable = [
        'form_pt_perorangan_id',
        'kbli_id',
    ];

    public function formPTPerorangan()
    {
        return $this->belongsTo(FormPTPerorangan::class);
    }

    public function kbli()
    {
        return $this->belongsTo(KBLI::class);
    }
}
