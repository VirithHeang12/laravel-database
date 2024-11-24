<?php

namespace App\Imports;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BooksImport implements ToCollection, WithStartRow
{
    private $successes = [];
    private $fails = [];

    public function startRow(): int
    {
        return 2; // Skip the header row
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            DB::beginTransaction();

            try {
                // Check if the row has at least 4 columns
                if (count($row) >= 4) {
                    Book::create([
                        'title'            => $row[0] ?? '',   // Use null coalescing to handle missing columns
                        'author'           => $row[1] ?? '',
                        'published_year'   => $row[2] ?? '',
                        'genre'            => $row[3] ?? '',
                    ]);

                    DB::commit();
                    $this->successes[] = $row;
                } else {
                    throw new \Exception('Insufficient data in row');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                // Log the error with the row data for later review
                $this->fails[] = [
                    'row'   => $row,
                    'error' => $e->getMessage(),
                ];
            }
        }
    }

    public function getSuccesses(): array
    {
        return $this->successes;
    }

    public function getFails(): array
    {
        return $this->fails;
    }
}

