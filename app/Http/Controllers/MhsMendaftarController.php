<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Periode;
use DB, Auth, PDF, Validator;

class MhsMendaftarController extends Controller
{
    public function imageBase64($path){
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $file = file_get_contents($path);
        
        return 'data:image/' . $type . ';base64,' . base64_encode($file); 
    }

    public function cetakPermohonanKp(){
        $img_logo = $this->imageBase64(base_path('public/assets/logo/unima.jpg'));
        

        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

        $pdf = PDF::loadView('cetak.form_permohonan_kp', compact('img_logo','pendaftaran'))
        ->setpaper('A4', 'potrait');

        return $pdf->stream();
    }

    public function cetakPengantarInstansi(){
        $img_logo = $this->imageBase64(base_path('public/assets/logo/unima.jpg'));
        $img_ttd = $this->imageBase64(base_path('public/assets/logo/ttd.jpg'));

        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

        $pdf = PDF::loadView('cetak.surat_pengantar_instansi', compact('img_logo','img_ttd','pendaftaran'))
        ->setpaper('A4', 'potrait');

        return $pdf->stream();
    }

    public function index()
    {        
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
        $periode = Periode::get(['id', 'nama']);

        return view('pages.mhs-mendaftar.index', compact('periode', 'pendaftaran'));
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
                'periode_id' => 'required',
                'nim' => 'required',
                'nama' => 'required',
                'prodi' => 'required',
                'sks_ditempuh' => 'required',
                'ipk' => 'required',
                'dosen_pembimbing_kp' => 'required',
                'nip' => 'required',
                'instansi_kp' => 'required',
            ];
    
            $messages  = [
                'periode_id.required' => 'PERIODE : Tidak boleh kosong.',
                'nim.required' => 'NIM : Tidak boleh kosong.',
                'nama.required' => 'NAMA : Tidak boleh kosong.',
                'prodi.required' => 'PROGRAM STUDI : Tidak boleh kosong.',
                'sks_ditempuh.required' => 'SKS DITEMPUH : Tidak boleh kosong.',
                'ipk.required' => 'IPK : Tidak boleh kosong.',
                'dosen_pembimbing_kp.required' => 'DOSEN PEMBIMBING KP : Tidak boleh kosong.',
                'nip.required' => 'NIP : Tidak boleh kosong.',
                'instansi_kp.required' => 'INSTANSI KP : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{  

                Pendaftaran::create([
                    'user_id' => Auth::id(),
                    'periode_id' => $request->periode_id,
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'prodi' => $request->prodi,
                    'sks_ditempuh' => $request->sks_ditempuh,
                    'ipk' => $request->ipk,
                    'judul_pra_proposal' => $request->judul_pra_proposal,
                    'dosen_pembimbing_kp' => $request->dosen_pembimbing_kp,
                    'nip' => $request->nip,
                    'instansi_kp' => $request->instansi_kp,
                ]);
    
                DB::commit();
                return response()->json(['status'=>'success', 'message'=>'Berhasil disimpan.'],200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // // START // jika status telah selesai, tidak dapat mengubah data
            // $check = Periode::where('id',$id)->first();
            // if($check->status === 'selesai') return response()->json(['status'=>'warning','message'=>'Tidak dapat merubah data periode karena status telah selesai.'],400);
            // // END // jika status telah selesai, tidak dapat mengubah data

            $rules = [
                'nim' => 'required',
                'nama' => 'required',
                'prodi' => 'required',
                'sks_ditempuh' => 'required',
                'ipk' => 'required',
                'dosen_pembimbing_kp' => 'required',
                'nip' => 'required',
                'instansi_kp' => 'required',
            ];
    
            $messages  = [
                'nim.required' => 'NIM : Tidak boleh kosong.',
                'nama.required' => 'NAMA : Tidak boleh kosong.',
                'prodi.required' => 'PROGRAM STUDI : Tidak boleh kosong.',
                'sks_ditempuh.required' => 'SKS DITEMPUH : Tidak boleh kosong.',
                'ipk.required' => 'IPK : Tidak boleh kosong.',
                'dosen_pembimbing_kp.required' => 'DOSEN PEMBIMBING KP : Tidak boleh kosong.',
                'nip.required' => 'NIP : Tidak boleh kosong.',
                'instansi_kp.required' => 'NIP : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                
                Pendaftaran::where('id',$id)->update([
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'prodi' => $request->prodi,
                    'sks_ditempuh' => $request->sks_ditempuh,
                    'ipk' => $request->ipk,
                    'judul_pra_proposal' => $request->judul_pra_proposal,
                    'dosen_pembimbing_kp' => $request->dosen_pembimbing_kp,
                    'nip' => $request->nip,
                    'instansi_kp' => $request->instansi_kp,
                ]);
    
                DB::commit();
                return response()->json(['status'=>'success', 'message'=>'Berhasil disimpan.'],200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }


    public function destroy($id)
    {
        //
    }
}
