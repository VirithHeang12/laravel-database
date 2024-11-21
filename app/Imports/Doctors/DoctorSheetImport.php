<?php

namespace App\Imports\Doctors;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\ToModel;

class DoctorSheetImport implements ToModel
{
    protected $specialty;
    protected $parentImport;

    public function __construct($specialty, $parentImport)
    {
        $this->specialty = $specialty;
        $this->parentImport = $parentImport;
    }

    public function model(array $row)
    {
        try {
            // Skip empty rows
            if (empty($row[0]) || empty($row[1])) {
                return null;
            }

            $doctor = new Doctor([
                'full_name'    => $row[0],
                'specialty'    => $this->specialty,
                'phone_number' => $row[1],
            ]);

            // Save success
            $this->parentImport->addSuccess($doctor);

            return $doctor;
        } catch (\Exception $e) {
            // Save failure
            $this->parentImport->addFail(['row' => $row, 'error' => $e->getMessage()]);
        }

        return null;
    }
}
