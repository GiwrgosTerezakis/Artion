<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Doctor extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'doctors';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];



    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }

}
