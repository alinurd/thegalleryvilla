<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::composer('applicant.cv.*', function ($view) {
        $navItem = [
            [
                    'url' => route('applicant.cv.biodata.index'),
                    'title' => 'Biodata',
                    'icon' => 'bi bi-person-badge'
            ],
            [
                'url' => route('applicant.cv.education-history.index'),
                'title' => 'Riwayat Pendidikan',
                'icon' => 'bi bi-book'
            ],
            [
                'url'=> route('applicant.cv.working-history.index'),
                'title' => 'Riwayat Pekerjaan',
                'icon' => 'bi bi-briefcase'
            ],
            [
                'url'=> route('applicant.cv.training-history.index'),
                'title' => 'Riwayat Pelatihan',
                'icon' => 'bi bi-briefcase'
            ],
            [
                'url' => route('applicant.cv.other.index'),
                'title' => 'Lainnya',
                'icon' => 'bi bi-gear'
            ]
        ];
        $view->with('navItem', $navItem);
    });
    }
}
