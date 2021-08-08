<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attandance extends Model
{
    protected $fillable = [
        'periode', 'masuk', 'keluar','ket','user_id '
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
