<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = ['football','basketball','volleyball','table_tennis','swimming','workout','riding','drawing','movies','gaming','travelling','music','walking','baseball','skiing','bowling'];
   

    public function users()
       {
           return $this->belongsToMany(User::class);
       }
}
