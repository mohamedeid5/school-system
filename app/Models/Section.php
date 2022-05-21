<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public $fillable = ['name', 'status', 'grade_id', 'classroom_id'];

    public function getStatus()
    {
        return $this->status == 1 ? __('sections.active')  : __('sections.inactive') ;
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
