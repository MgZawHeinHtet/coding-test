<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function scopeFilter($query,$requests){
        if($search = $requests['search']??null){
            $query->where(function($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('website', 'like', '%' . $search . '%');
            });
        }

        if($filter = $requests['filter']??null){
            switch ($filter) {
                case 'last-day':
                    $last_day = date('y-m-d',strtotime("-1 days")) ;
                    $query->where('created_at',$last_day);
                    
                    break;
                case '7-days' : 
                    $seven_days = date('y-m-d',strtotime("-7 days"));
                    $query->where('created_at',">=",$seven_days);
                case 'last-month' :
                    $last_month = date('m',strtotime("-1 month"));
                    $query->whereMonth('created_at',$last_month);

                default:
                    # code...
                    break;
            }
        }
    }
}
