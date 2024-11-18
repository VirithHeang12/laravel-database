<?php

namespace App\Imports;

use App\Models\Car;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CarsImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            DB::beginTransaction();

            try {
                Car::create([
                    'model'         => $row[0],
                    'year'          => $row[1],
                    'color'         => $row[2],
                    'engine_type'   => $row[3],
                    'price'         => $row[4]
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
    }
}
