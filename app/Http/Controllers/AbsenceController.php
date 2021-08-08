<?php

namespace App\Http\Controllers;

use App\Absence;
use Illuminate\Http\Request;
use Validator;
use DB;
class AbsenceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensi = Absence::where('user_id',auth()->user()->id)->get();
        return view('aplikasi.absensi',compact('absensi'));
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
        //dd($request->all());
        try {
            DB::beginTransaction();
            if($request->alasan=='sakit'){
                $rules=[
                    'alasan' => 'required|string|in:cuti,sakit',
                    'tgl_sekarang' => 'required|date',
                    'tgl_awal' => 'required|date|before_or_equal:tgl_sekarang',
                    'tgl_akhir' => 'required|date',
                ];
            }else if($request->alasan=='cuti'){
                $rules=[
                    'alasan' => 'required|string|in:cuti,sakit',
                    'tgl_sekarang' => 'required|date',
                    'tgl_awal' => 'required|date|after:tgl_sekarang',
                    'tgl_akhir' => 'required|date',
                ];
            }

            $validator=Validator::make($request->all(),$rules);
            if($validator->fails()){
                $msg='';
                foreach ($validator->errors()->all() as $error) { $msg=$msg.$error; }
                toast()->error("Gagal mengajukan absensi! ".$msg);
                return back();
            }

            $a = new Absence();
            $a->tgl_awal = $request->tgl_awal;
            $a->tgl_akhir = $request->tgl_akhir;
            $a->alasan = $request->alasan;
            $a->status = 'menunggu';
            $a->user_id = auth()->user()->id;
            $a->save();
            DB::commit();
            toast()->success("Pengajuan Absensi Berhasil!");
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
     * @param  \App\Absence  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absence  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absence  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absensi)
    {
        echo "asd";
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absence  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absensi)
    {
        //
    }


}
