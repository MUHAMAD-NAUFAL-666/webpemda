<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class AnotherWidget extends Widget
{
    protected static string $view = 'filament.widgets.another-widget'; // Pastikan view diatur dengan benar

    public function render(): View
    {
        return view(static::$view);
    }
}
