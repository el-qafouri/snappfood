<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;


class OrdersExport implements FromCollection
{

    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        return Order::all();
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




    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setTitle('Orders for ' . date('F Y'));

                // تعریف داده های نمودار
                $dataSeriesLabels = [
                    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$1', null, 1), //  عنوان سری داده
                ];
                $xAxisTickValues = [
                    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$5', null, 4), //  مقادیر محور X
                ];
                $dataSeriesValues = [
                    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$2:$B$5', null, 4), //  داده‌ها
                ];

                // ایجاد نمودار
                $series = new DataSeries(
                    DataSeries::TYPE_LINECHART, // نوع نمودار
                    DataSeries::GROUPING_STANDARD, // نوع گروه‌بندی
                    range(0, count($dataSeriesValues) - 1), // محدوده سری‌های داده
                    $dataSeriesLabels, // برچسب‌های نمودار
                    $xAxisTickValues, // مقادیر محور X
                    $dataSeriesValues        // داده‌های نمودار
                );

                $plotArea = new PlotArea(null, [$series]); // منطقه ترسیم
                $legend = new Legend(Legend::POSITION_RIGHT, null, false); // افسانه
                $title = new Title('Sales by Month'); // عنوان نمودار

                $chart = new Chart(
                    'chart1', // نام نمودار
                    $title, // عنوان
                    $legend, // افسانه
                    $plotArea, // منطقه ترسیم
                    true,
                    0,
                    null, // عنوان محور X
                    null  // عنوان محور Y
                );

                // مکان نمودار در ورک‌شیت
                $chart->setTopLeftPosition('A7');
                $chart->setBottomRightPosition('H20');

                // اضافه کردن نمودار به ورک‌شیت
                $event->sheet->getDelegate()->addChart($chart);
            },
        ];
    }



}



