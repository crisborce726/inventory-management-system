<?php

namespace App\Charts;

use App\Models\Transaction;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Transactions')
            ->setSubtitle('as of '. \Carbon\Carbon::parse(today())->format('F j, Y'))
            ->addData('Medicine', [
                Transaction::whereMonth('created_at', '=', date('m', strtotime(' - 5 months')))->sum('transactions.quantity'),
                Transaction::whereMonth('created_at', '=', date('m', strtotime(' - 4 months')))->sum('transactions.quantity'),
                Transaction::whereMonth('created_at', '=', date('m', strtotime(' - 3 months')))->sum('transactions.quantity'),
                Transaction::whereMonth('created_at', '=', date('m', strtotime(' - 2 months')))->sum('transactions.quantity'),
                Transaction::whereMonth('created_at', '=', date('m', strtotime(' - 1 months')))->sum('transactions.quantity'),
                Transaction::whereMonth('created_at', date('m'))->sum('transactions.quantity'),
                ])
            ->setXAxis([
                date('M Y', strtotime(' - 5 months')),
                date('M Y', strtotime(' - 4 months')),
                date('M Y', strtotime(' - 3 months')),
                date('M Y', strtotime(' - 2 months')),
                date('M Y', strtotime(' - 1 months')),
                date('M Y'),
        ]);
    }
}
