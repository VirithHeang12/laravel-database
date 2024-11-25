<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class CustomersExport implements FromView, WithHeadings
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
        // return $this->fails;
        return Customer::all();
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $customers = Customer::all();
        
        // Count total, female, and male customers
        $totalCustomers = $customers->count();
        $femaleCustomers = $customers->where('gender', 'Female')->count();
        $maleCustomers = $customers->where('gender', 'Male')->count();

        return view('customers.export', [
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'femaleCustomers' => $femaleCustomers,
            'maleCustomers' => $maleCustomers,
        ]);
    }


    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'B2';
    }
}