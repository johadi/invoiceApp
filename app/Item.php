<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=['description','price','invoice_id','title','total','quantity'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
