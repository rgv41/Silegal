<?php

// app/Imports/KbliCategoryImport.php
namespace App\Imports;

use App\Models\KbliCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class KbliCategoryImport implements ToModel
{
    public function model(array $row)
    {
        Log::info('Data yang diimpor: ', $row);

        return new KbliCategory([
            'category_name' => $row[0],
        ]);
    }
}
