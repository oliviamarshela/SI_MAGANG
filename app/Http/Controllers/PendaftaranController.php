<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\UnggahBerkas;
use RealRashid\SweetAlert\Facades\Alert;
use DB, DataTables, Validator;

class PendaftaranController extends Controller
{

    public function index()
    {   
        $pendaftaran = Pendaftaran::orderBy('created_at','DESC')->get(['id','nama','nim','sks_ditempuh','ipk','judul_pra_proposal','dosen_pembimbing_kp','instansi_kp','status']);

        return view('pages.pendaftaran.index', compact('pendaftaran'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $rules = [
                'status' => 'required',
            ];
    
            $messages  = [
                'status.required' => 'Status : Tidak boleh kosong.',
            ];
    
            $request->validate($rules, $messages);

            Pendaftaran::where('id',$request->pendaftaran_id)->update([
                'status' => $request->status,
            ]);
            
            UnggahBerkas::where('pendaftaran_id',$request->pendaftaran_id)->update([
                'keterangan_konfirmasi' => $request->keterangan_konfirmasi
            ]);

            Alert::success('Berhasil', "Berhasil disimpan.");
            DB::commit();
            return redirect()->route('pendaftaran.show',$request->pendaftaran_id);
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::where('id',$id)->first();
        $berkas = UnggahBerkas::where('pendaftaran_id', $id)->first();

        return view('pages.pendaftaran.detail', compact('pendaftaran','berkas'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
