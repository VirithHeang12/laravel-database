<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorsExport implements FromCollection, WithHeadings
{
    private Collection $fails;
    private int $successesCount = 0;
    private int $failsCount = 0;

    public function setSuccessesCount(int $successesCount): void
    {
        $this->successesCount = $successesCount;
    }

    public function setFailsCount(int $failsCount): void
    {
        $this->failsCount = $failsCount;
    }

    public function setFails(Collection $fails): void
    {
        $this->fails = $fails;
    }

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

    public function collection()
    {
        return $this->fails;
    }
}
