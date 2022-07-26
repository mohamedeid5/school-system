<?php

namespace App\Providers;

use App\Interfaces\PromotionRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
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
