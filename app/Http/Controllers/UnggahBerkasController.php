<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnggahBerkas;
use App\Models\Pendaftaran;
use RealRashid\SweetAlert\Facades\Alert;
use File, DB, Auth;

class UnggahBerkasController extends Controller
{

    public function index()
    {
        $unggahBerkas = UnggahBerkas::where('user_id', Auth::id())->first();
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

        return view('pages.unggah-berkas.index', compact('unggahBerkas','pendaftaran'));
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
                'permohonan_kp' => 'required|mimes:pdf|max:250',
            ];

            $request->validate($rules,
            [
                'permohonan_kp.required' => 'Permohonan KP : Tidak boleh kosong.',
                'permohonan_kp.mimes' => 'Permohonan KP : Format berkas tidak sesuai.',
                'permohonan_kp.max' => 'Permohonan KP : Melewati batas maksimal ukuran 250kb.',
            ]);

            $checkUpload = UnggahBerkas::where('user_id', Auth::id())->first();

            if($checkUpload){
                File::delete(public_path($checkUpload->permohonan_kp));

                $checkUpload->delete();
            }

            $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

            UnggahBerkas::create([
                'pendaftaran_id' => $pendaftaran?->id,
                'user_id' => Auth::id(),
                'permohonan_kp' => $this->uploadFile($request->file('permohonan_kp'), 'permohonan-kp'),
            ]);

            $pendaftaran->update([
                'status' => 'diunggah'
            ]);

            Alert::success('Berhasil', "Berhasil disimpan.");
            DB::commit();
            return redirect()->route('unggah-berkas.index');
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function unggahBalasanInstansi(Request $request)
    {
        DB::beginTransaction();

        try {
            $rules = [
                'surat_balasan_instansi' => 'required|mimes:pdf|max:250',
            ];

            $request->validate($rules,
            [
                'surat_balasan_instansi.required' => 'Surat Balasan Instansi : Tidak boleh kosong.',
                'surat_balasan_instansi.mimes' => 'Surat Balasan Instansi : Format berkas tidak sesuai.',
                'surat_balasan_instansi.max' => 'Surat Balasan Instansi : Melewati batas maksimal ukuran 250kb.',
            ]);

            $checkUpload = UnggahBerkas::where('user_id', Auth::id())->first();

            if($checkUpload){
                File::delete(public_path($checkUpload->surat_balasan_instansi));
            }
            
            $checkUpload->update([
                'surat_balasan_instansi' => $this->uploadFile($request->file('surat_balasan_instansi'), 'surat-balasan-instansi'),
            ]);

            Alert::success('Berhasil', "Berhasil disimpan.");
            DB::commit();
            return redirect()->route('unggah-berkas.index');
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }


    public function uploadFile($file, $name){
        $uploadFolder = 'files';
        $fileType = $file->extension();
        $fileName = Auth::id()."-".$name."-".date('yMdhis').".".$fileType;
        $file->move($uploadFolder, $fileName);
        
        return $uploadFolder.'/'.$fileName;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
