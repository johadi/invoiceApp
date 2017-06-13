<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Client extends Model
{
    protected $fillable=['first_name','last_name','email','phone1','phone2','company_name','company_address','gender'];
    public static function addClient($request){
        static::create($request);
    }
    public function scopeUpdateClient($query,$request,$client_id){
        $query->where('id',$client_id)->update($request);
    }
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
