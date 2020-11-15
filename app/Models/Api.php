<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Api extends Model
{
    use HasFactory;
    use Filterable;

    public $table = 'api';


    protected $dates = [
        'date_posted',
    ];


    private static $whiteListFilter = ['*'];

    protected $fillable = [
        'title',
        'text',
        'author',
        'views',
        'date_posted',
    ];


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
