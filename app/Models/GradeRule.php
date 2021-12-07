<?php

namespace App\Models;

use App\Models\GradingSystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GradeRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'point',
        'grade',
        'start_at',
        'end_at',
        'grading_system_id',
        'session_id'
    ];

    public function gradingSystem() {
        return $this->belongsTo(GradingSystem::class, 'grading_system_id');
    }
}
