<?php

namespace App\Imports;

use App\Models\Car;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CarsImport implements ToCollection, WithStartRow
{
    private $sucesses = [];
    private $fails = [];

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
                $this->sucesses[] = $row;
            } catch (\Exception $e) {
                DB::rollBack();
                $this->fails[]  = [
                    $row[0],
                    $row[1],
                    $row[2],
                    $row[3],
                    $row[4],
                    $e->getMessage()
                ];
            }
        }
    }

    public function getSucesses(): array
    {
        return $this->sucesses;
    }

    public function getFails(): array
    {
        return $this->fails;
    }
}
