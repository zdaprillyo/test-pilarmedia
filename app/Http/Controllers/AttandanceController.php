<?php

namespace App\Http\Controllers;

use App\Attandance;
use Illuminate\Http\Request;
use DB;
use Exception;
use App\User;
class AttandanceController extends Controller
{
    public function laporan(){
        $laporan=[];
        $users = User::where('role','karyawan')->get();
        // foreach ($users as $u) {
        //    $kehadiran = Attandance::whereMonth('periode',date('m'))->where('user_id',$u->id)->get();
        //    $cuti = Attandance::whereMonth('periode',date('m'))->where('user_id',$u->id)->where('ket','cuti')->get();
        //    $sakit = Attandance::whereMonth('periode',date('m'))->where('user_id',$u->id)->where('ket','sakit')->get();
        //    $laporan['karyawan'][]=$u->name;
        //    $laporan['peforma']['periode'][]=date('m-Y');
        //    $laporan['peforma']['presensi'][]=count($kehadiran);
        //    $laporan['peforma']['absensi'][]=date('d')-count($kehadiran)+1;
        //    $laporan['peforma']['cuti'][]=count($cuti);
        //    $laporan['peforma']['sakit'][]=count($sakit);
        //    $laporan['peforma']['tanpaKet'][]=date('d')-count($kehadiran)+1;
        // }
        // dd($laporan);
        return view('aplikasi.laporan',compact('users'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attandances = Attandance::where('user_id',auth()->user()->id)->get();
        return view('aplikasi.presensi',compact('attandances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if(!auth()->user()->isAttend()){
                $a = new Attandance();
                $a->periode = date('Y-m-d');
                $a->masuk = date('Y-m-d H:i:s');
                $a->ket = 'hadir';
                $a->user_id = auth()->user()->id;
                if(time()<=strtotime(date('09:00'))){
                    toast()->success('Presensi Masuk Berhasil!');
                }else{
                    toast()->error('Presensi Masuk Berhasil! Anda terlambat presensi');
                }
                $a->save();
            }else {
                $a = Attandance::where('user_id',auth()->user()->id)->whereDate('periode',date('Y-m-d'))->get();
                $a[0]->update(['keluar'=>date('Y-m-d H:i:s')]);
                if(time()>=strtotime(date('17:00'))){
                    toast()->success('Presensi Pulang Berhasil!');
                }else{
                    toast()->error('Presensi Pulang Berhasil! Anda pulang terlalu awal');
                }
            }
            DB::commit();
            return back();
        } catch (Exception $ex) {
            DB::rollBack();
            toast()->error('Presensi Gagal!. '.$ex->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attandances  $attandances
     * @return \Illuminate\Http\Response
     */
    public function show(Attandances $attandances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attandances  $attandances
     * @return \Illuminate\Http\Response
     */
    public function edit(Attandances $attandances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attandances  $attandances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attandances $attandances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attandances  $attandances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attandances $attandances)
    {
        //
    }
}
