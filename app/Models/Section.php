<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    public $fillable = ['name', 'status', 'grade_id', 'classroom_id'];

    public function getStatus(): string
    {
        return $this->status == 1 ? __('sections.active')  : __('sections.inactive') ;
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
}
