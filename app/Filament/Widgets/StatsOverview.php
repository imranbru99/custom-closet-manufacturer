<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $openOrders = Order::query()->whereNotIn('status', ['closed', 'installed'])->count();
        $revenue = (float) Invoice::query()->where('status', 'paid')->sum('total');
        $pipeline = (float) Order::query()->whereIn('status', ['quoted', 'approved', 'in_production'])->sum('total');

        return [
            Stat::make('Customers', Customer::query()->count())
                ->description('Active client records')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            Stat::make('Open Closet Orders', $openOrders)
                ->description('In design or production')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),
            Stat::make('Paid Revenue', '$'.number_format($revenue, 0))
                ->description('Collected invoices')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Production Pipeline', '$'.number_format($pipeline, 0))
                ->description(Appointment::query()->where('starts_at', '>=', now())->count().' upcoming appointments')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
        ];
    }
}
