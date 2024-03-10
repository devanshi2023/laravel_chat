<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\Employee as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

     protected $table   = 'Employee';
     protected $guarded = ['created_at,updated_at,deleted_at'];

     public static function boot()
     {
         parent::boot();

                static::creating(function ($data)
                {
                    $data->created_by = auth()->user()->id;
                });
                static::updating(function ($data)
                {
                    $data->updated_by = auth()->user()->id;
                });

         static::deleting(function ($data)
         {
             $data->deleted_by = auth()->user()->id;
             $data->save();
         });
     }

}
