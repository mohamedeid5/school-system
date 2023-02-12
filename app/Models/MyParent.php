<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;



class MyParent extends Authenticatable
{
    use HasFactory, HasTranslations;

    public array $translatable = ['father_name', 'mother_name', 'father_job', 'mother_job'];

    protected $guarded = [];


}
