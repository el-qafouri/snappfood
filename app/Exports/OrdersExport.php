<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class OrdersExport implements FromCollection
{

    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
//    public function collection()
//    {
//        return Order::all();
//    }
//
//
//    public function query()
//    {
//        return Order::query();
//    }


    public function collection()
    {
        return Order::all(); // یا هر query دیگری که برای فیلتر کردن نتایج می‌خواهید
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Order Date',
            'Status',
        ];
    }

}



