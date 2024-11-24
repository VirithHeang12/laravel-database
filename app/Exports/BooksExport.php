<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class BooksExport implements FromCollection, WithHeadings
{
    private Collection $fails;
    private int $successesCount = 0;
    private int $failsCount = 0;

    /**
     * Set the successes count
     *
     * @param int $successesCount
     *
     * @return void
     */
    public function setSuccessesCount(int $successesCount): void
    {
        $this->successesCount = $successesCount;
    }

    /**
     * Set the fails count
     *
     * @param int $failsCount
     *
     * @return void
     */
    public function setFailsCount(int $failsCount): void
    {
        $this->failsCount = $failsCount;
    }

    /**
     * Set the fails
     *
     * @param Collection $fails
     *
     * @return void
     */

    public function setFails(Collection $fails): void
    {
        $this->fails = $fails;
    }

    /**
     * WithHeadings
     *
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            '#',
            'Successes',
            "$this->successesCount",
            'Fails',
            "$this->failsCount",
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->fails;
    }
}
