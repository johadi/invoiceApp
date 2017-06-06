<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=['invoice_number','payment_method','client_id','admin_id','ekaruz_id','due_date','completed'];
    protected $dates=['due_date'];
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function ekaruz(){//to get ekaruz details
        return $this->belongsTo(Ekaruz::class);
    }
}
