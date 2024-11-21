<?php

namespace App\Imports\Doctors;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DoctorsImport implements WithMultipleSheets
{
    protected $sheetSpecialties;
    protected $successes = [];
    protected $fails = [];

    public function __construct($sheetSpecialties)
    {
        $this->sheetSpecialties = $sheetSpecialties;
    }

    public function sheets(): array
    {
        $sheetImports = [];
        foreach ($this->sheetSpecialties as $sheetIndex => $specialty) {
            $sheetImports[$sheetIndex] = new DoctorSheetImport($specialty, $this);
        }
        return $sheetImports;
    }
    public function addSuccess($data)
    {
        $this->successes[] = $data;
    }

    public function addFail($data)
    {
        $this->fails[] = $data;
    }

    public function getSuccesses()
    {
        return $this->successes;
    }

    public function getFails(): array
    {
        return $this->fails;
    }
}
