<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;
use Spatie\Activitylog\Models\Activity;

class LoginHistory extends Widget
{
    protected static string $view = 'filament.admin.widgets.login-history';

    public function getRecords()
    {
        return Activity::where('log_name', 'Access')
            ->where(function ($q) {
                $q->where('description', 'like', '%logged in%')
                    ->orWhere('description', 'like', '%logged out%');
            })
            ->with('causer')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }
}
