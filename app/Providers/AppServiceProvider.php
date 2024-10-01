<?php

namespace App\Providers;

use App\Filament\Resources\GradeResource;
use App\Filament\Resources\StudentResource;
use App\Models\Grade;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::unguard();

        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Grade')
                    ->url(GradeResource::getUrl())
                    ->label('School Grade Management')
                    ->icon('heroicon-o-academic-cap')
                    ->activeIcon('heroicon-s-academic-cap')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.grades.*') || request()->routeIs('filament.admin.resources.grades/groups.*') || request()->routeIs('filament.admin.resources.groups.*')),
            ]);
        });

        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Student')
                    ->url(StudentResource::getUrl())
                    ->label('Student Management')
                    ->icon('heroicon-o-academic-cap')
                    ->activeIcon('heroicon-s-academic-cap')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.students.*') || request()->routeIs('filament.admin.resources.representatives.*')),
            ]);
        });
    }
}
