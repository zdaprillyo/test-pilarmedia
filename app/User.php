<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Attandance;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function absences(){
        return $this->hasMany('App\Absence');
    }
    public function attandances(){
        return $this->hasMany('App\Attandance');
    }
    public static function getAttandanceToDay(){
        return self::whereDate('periode',date('Y-m-d'))->get();
    }
    public function isAttend(){
        $p = Auth::user()->attandances()->whereDate('periode',date('Y-m-d'))->get();
        if(!empty($p[0])){
            return true;
        }else{
            return false;
        }
    }
    public function isHome(){
        $p = Auth::user()->attandances()->whereDate('periode',date('Y-m-d'))->get();
        if(is_null($p[0]->keluar)){
            return false;
        }else{
            return true;
        }
    }
    public function getPresenCount(){
        return count(Attandance::whereMonth('periode',date('m'))->where('user_id',$this->id)->where('ket','hadir')->get());
    }
    public function getAbsenCount(){
        return $this->getCutiCount()+$this->getSakitCount();
    }
    public function getCutiCount(){
        return count(Attandance::whereMonth('periode',date('m'))->where('user_id',$this->id)->where('ket','cuti')->get());
    }
    public function getSakitCount(){
        return count(Attandance::whereMonth('periode',date('m'))->where('user_id',$this->id)->where('ket','sakit')->get());
    }


}
