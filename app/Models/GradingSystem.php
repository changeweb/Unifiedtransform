<?php

namespace App\Models;

use App\Models\Semester;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GradingSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_name',
        'class_id',
        'semester_id',
        'session_id'
    ];

    public function semester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
