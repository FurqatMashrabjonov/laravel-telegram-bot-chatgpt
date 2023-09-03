<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ChatUsers extends ChartWidget
{
    protected static ?string $heading = 'All Telegram Users';

    public array $data;

    public function __construct()
    {
        $userCounts = DB::table('telegraph_chats')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        foreach ($userCounts as $userCount) {
            $this->data[] = [
                'month' => date('F Y', strtotime("{$userCount->year}-{$userCount->month}-01")),
                'count' => $userCount->count,
            ];
        }

    }

    protected function getData(): array
    {
             return [
                 'datasets' => [
                     [
                         'label' => 'Telegram Users',
                         'data' => array_column($this->data, 'count'),
                     ],
                 ],
                 'labels' => array_column($this->data, 'month'),
             ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
