<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekaruz extends Model
{
    protected $fillable=['phone1','phone2','email','street_address','state_address','town_address'];

    public function scopeUpdateDetail($query,$request){
        $ekaruz=$query->find(1);
        if($request['phone1']) $ekaruz->phone1=$request['phone1'];
        if($request['phone2']) $ekaruz->phone2=$request['phone2'];
        if($request['email']) $ekaruz->email=$request['email'];
        if($request['street_address']) $ekaruz->street_address=$request['street_address'];
        if($request['town_address']) $ekaruz->town_address=$request['town_address'];
        if($request['state_address']) $ekaruz->state_address=$request['state_address'];
        $ekaruz->save();
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
