<?php

namespace App\Providers;

use App\Interfaces\FeesRepositoryInterface;
use App\Interfaces\FeesTypeRepositoryInterface;
use App\Interfaces\GraduatesRepositoryInterface;
use App\Interfaces\PromotionRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Repositories\FeesRepository;
use App\Repositories\FeesTypeRepository;
use App\Repositories\GraduatesRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(GraduatesRepositoryInterface::class, GraduatesRepository::class);
        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);
        $this->app->bind(FeesTypeRepositoryInterface::class, FeesTypeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
