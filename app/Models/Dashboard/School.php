<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'char';
    protected $table = 'schools';
    protected $primaryKey = 'id';

    protected $fillable = ['school_name', 'email', 'contact', 'address'];
}
