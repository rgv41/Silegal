<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'form_type',
        'form_id',
        'user_id',  // Ini akan merujuk ke form yang terkait
        'status',
        'revision_message',
    ];

    public function files()
    {
        return $this->hasMany(DocumentFile::class);
    }
}
