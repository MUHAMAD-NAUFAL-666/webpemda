<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use App\Models\Loan; 
use Illuminate\Support\Facades\Log;
class CustomStatsWidget extends Widget
{
    protected static string $view = 'filament.widgets.custom-dashboard-widget';

    public function getTotalUsers()
    {
        return 100; // Ganti dengan query yang sesuai
    }

    public function getTotalBooks()
    {
        return 200; // Ganti dengan query yang sesuai
    }

    public function getActiveLoans()
    {
        return Loan::where('status', 'active')->count();
    }

    // Sesuaikan metode render dengan tipe yang diharapkan
    public function render(): View
    {
        Log::info('Rendering CustomStatsWidget with data:', [
            'totalUsers' => $this->getTotalUsers(),
            'totalBooks' => $this->getTotalBooks(),
            'activeLoans' => $this->getActiveLoans(),
        ]);
        
        return view(static::$view, [
            'totalUsers' => $this->getTotalUsers(),
            'totalBooks' => $this->getTotalBooks(),
            'activeLoans' => $this->getActiveLoans(),
        ]);
    }
}
