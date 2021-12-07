<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name', 'room_no', 'class_id', 'session_id'];

    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
