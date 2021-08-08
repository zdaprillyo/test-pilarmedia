<?php

use Illuminate\Database\Seeder;
use App\Attandance;
use App\User;
class AbsencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $users = User::where('role','karyawan')->get();
        foreach ($users as $u) {
            $tglNow = date('Y-m').'-01';
            for ($i=1; $i <= date('t'); $i++) {
                $a = new Attandance();
                $a->periode=$tglNow;
                $a->masuk=$tglNow.' 07:00';
                $a->keluar=$tglNow.' 17:00';
                $a->ket='hadir';
                $a->user_id=$u->id;
                $a->save();
                $tglNow = date('Y-m-d', strtotime($tglNow." +$i day "));
            }
        }
    }
}
