<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile',
        'company_id',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeFilter($query,$requests){
        if($search = $requests['search']??null){
            $query->where(function($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if($filter = $requests['filter']??null){
            $query->where('company_id',$filter);
        }
    }
}
