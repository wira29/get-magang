<?php

namespace App\Models\Dashboard;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'char';
    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $fillable = ['student_name', 'gender', 'school_id', 'user_id', 'rfid', 'status'];

    /**
     * Relationship many-to-one with school
     * 
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }


    /**
     * Relationship many-to-one with Attendances
     * 
     * @return BelongsTo
     */

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
