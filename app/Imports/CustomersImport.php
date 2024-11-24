<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CustomersImport implements ToCollection, WithStartRow
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
                Customer::create([
                    'name'         => $row[0],
                    'gender'          => $row[1],
                    'phone'          => $row[2]
                ]);

                DB::commit();
                $this->sucesses[] = $row;
            } catch (\Exception $e) {
                DB::rollBack();
                $this->fails[]  = [
                    $row[0],
                    $row[1],
                    $row[2],
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