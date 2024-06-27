<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\UnggahBerkas;
use App\Models\Pendaftaran;
use RealRashid\SweetAlert\Facades\Alert;
use File, DB, Auth;

class UnggahLaporanController extends Controller
{

    public function index()
    {
        $laporan = Laporan::where('user_id', Auth::id())->first();
        $unggahBerkas = UnggahBerkas::where('user_id', Auth::id())->first();
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

        return view('pages.unggah-laporan.index', compact('laporan','unggahBerkas','pendaftaran'));
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
                'file' => 'required|mimes:pdf|max:10000',
                'keterangan' => 'required'
            ];

            $request->validate($rules,
            [
                'file.required' => 'Laporan : Tidak boleh kosong.',
                'file.mimes' => 'Laporan : Format berkas tidak sesuai.',
                'file.max' => 'Laporan : Melewati batas maksimal ukuran 200kb.',
                'keterangan.required' => 'Keterangan : Tidak boleh kosong.',
            ]);

            $laporan = Laporan::where('user_id', Auth::id())->first();

            if($laporan){
                File::delete(public_path($laporan->file));

                $laporan->update([
                    'file' => $this->uploadFile($request->file('file'), 'laporan-kp'),
                    'keterangan' => $request->keterangan
                ]);
            }else{
                $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

                Laporan::create([
                    'pendaftaran_id' => $pendaftaran?->id,
                    'user_id' => Auth::id(),
                    'file' => $this->uploadFile($request->file('file'), 'laporan-kp'),
                    'keterangan' => $request->keterangan
                ]);
            }

            Alert::success('Berhasil', "Berhasil disimpan.");
            DB::commit();
            return redirect()->route('unggah-laporan.index');
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
