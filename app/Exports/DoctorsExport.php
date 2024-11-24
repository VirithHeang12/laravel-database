<?php

namespace App\Exports;

use App\Models\Doctor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class DoctorsExport implements FromView, WithCustomStartCell
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

    // public function collection()
    // {
    //     return $this->fails;
    // }

    //  public function query(): \Illuminate\Database\Eloquent\Builder
    // {
    //     return Doctor::query();
    // }

    public function view(): View
    {
        // return view('doctors.export', [
        //     'doctors' => Doctor::all()
        // ]);
        $specialties = Doctor::select('specialty', DB::raw('count(*) as count'))
        ->groupBy('specialty')
        ->get();

        // Return the view with the data
        return view('doctors.export', [
            'specialties' => $specialties
        ]);
    }
    public function startCell(): string
    {
        return 'B2';
    }
}

