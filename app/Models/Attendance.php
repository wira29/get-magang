<?php

namespace App\Models;

use App\Models\Dashboard\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'char';
    protected $table = 'attendances';
    protected $primaryKey = 'id';

    protected $fillable = ['student_id', 'status'];

    /**
     * Relationship many-to-one with detail attendances
     * 
     * @return HasMany
     */

    public function detail_attendances(): HasMany
    {
        return $this->hasMany(DetailAttendance::class);
    }

    /**
     * Relationship many-to-one with detail attendances
     * 
     * @return BelongsTo
     */

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
