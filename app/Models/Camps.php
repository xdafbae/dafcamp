<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Checkout;
use PhpParser\Node\Stmt\Return_;

class Camps extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'price'];

    public function getIsRegisteredAttribute()
    {
        if(!Auth::check()){
            return false;
        }
        return Checkout::whereCampsId($this->id)->whereUserId(Auth::id())->exists();
    }

}
