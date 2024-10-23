<?php

// app/Imports/KbliImport.php
namespace App\Imports;

use App\Models\Kbli;
use Maatwebsite\Excel\Concerns\ToModel;

class KbliImport implements ToModel
{
    public function model(array $row)
    {
        // Cek apakah kbli_category_id valid
        $categoryExists = \App\Models\KbliCategory::find($row[2]);

        if ($categoryExists) {
            return new Kbli([
                'kode_kbli' => $row[0],
                'deskripsi_kbli' => $row[1],
                'kbli_category_id' => $row[2],
            ]);
        } else {
            // Abaikan atau log data jika category_id tidak valid
            return null;
        }
    }
}
