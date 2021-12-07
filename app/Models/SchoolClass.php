<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Section;
use App\Models\Syllabus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = ['class_name', 'session_id'];

    /**
     * Get the sections for the class.
     */
    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id', 'id');
    }

    /**
     * Get the courses for the class.
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id', 'id');
    }

    /**
     * Get the syllabi for the class.
     */
    public function syllabi()
    {
        return $this->hasMany(Syllabus::class, 'class_id', 'id');
    }
}
