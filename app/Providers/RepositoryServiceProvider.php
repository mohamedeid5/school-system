<?php

namespace App\Providers;

use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\LibraryRepositoryInterface;
use App\Interfaces\OnlineClassRepositoryInterface;
use App\Interfaces\QuestionRepositoryInterface;
use App\Interfaces\QuizRepositoryInterface;
use App\Interfaces\FeeInvoicesRepositoryInterface;
use App\Interfaces\FeesRepositoryInterface;
use App\Interfaces\ProcessingFeesRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Interfaces\FeesTypeRepositoryInterface;
use App\Interfaces\GraduatesRepositoryInterface;
use App\Interfaces\PromotionRepositoryInterface;
use App\Interfaces\SettingsRepositoryInterface;
use App\Interfaces\StudentReceiptRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\SubjectsRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Repositories\AttendanceRepository;
use App\Repositories\LibraryRepository;
use App\Repositories\OnlineClassRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuizRepository;
use App\Repositories\FeeInvoicesRepository;
use App\Repositories\FeesRepository;
use App\Repositories\ProcessingFeesRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\FeesTypeRepository;
use App\Repositories\GraduatesRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\StudentReceiptRepository;
use App\Repositories\SubjectsRepository;
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
        $this->app->bind(FeeInvoicesRepositoryInterface::class, FeeInvoicesRepository::class);
        $this->app->bind(StudentReceiptRepositoryInterface::class, StudentReceiptRepository::class);
        $this->app->bind(ProcessingFeesRepositoryInterface::class, ProcessingFeesRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectsRepositoryInterface::class, SubjectsRepository::class);
        $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(OnlineClassRepositoryInterface::class, OnlineClassRepository::class);
        $this->app->bind(LibraryRepositoryInterface::class, LibraryRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);

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
