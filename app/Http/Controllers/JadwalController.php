<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use App\Models\Jadwal;
use DB, DataTables, Validator;

class JadwalController extends Controller
{

    public function daftarPeriode(){
        $periode = Periode::orderBy('created_at', 'DESC')->get();

        return view('pages.daftar-periode.index', compact('periode'));
    }

    public function index()
    {
        return view('pages.jadwal.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {  
            // START // jika ada jadwal dengan tipe yg sama, tidak dapat menambah jadwal baru
            $checkJadwal = Jadwal::where('periode_id',$request->periode_id)->first();
            $checkPeriode = Periode::where('id',$request->periode_id)->first();

            if($checkPeriode?->status === "selesai") return response()->json(['status'=>'warning','message'=>'Tidak dapat menambah jadwal, periode telah selesai.'],400);
            if($checkJadwal?->tipe === $request->tipe) return response()->json(['status'=>'warning','message'=>'Jadwal sudah tersedia.'],400);

            $rules = [
                'periode_id' => 'required',
                'tanggal' => 'required',
                'jam' => 'required',
                'tipe' => 'required',
            ];
    
            $messages  = [
                'periode_id.required' => 'Periode : Tidak boleh kosong.',
                'tanggal.required' => 'Tanggal : Tidak boleh kosong.',
                'jam.required' => 'Jam : Tidak boleh kosong.',
                'tipe.required' => 'Tipe : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                 
                Jadwal::create([
                    'periode_id' => $request->periode_id,
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'tipe' => $request->tipe,
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
        //
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $checkPeriode = Periode::where('id',$request->periode_id)->first();
            if($checkPeriode?->status === "selesai") return response()->json(['status'=>'warning','message'=>'Tidak dapat diubah, periode telah selesai.'],400);

            $rules = [
                'tanggal' => 'required',
                'jam' => 'required',
                'tipe' => 'required',
            ];
    
            $messages  = [
                'tanggal.required' => 'Tanggal : Tidak boleh kosong.',
                'jam.required' => 'Jam : Tidak boleh kosong.',
                'tipe.required' => 'Tipe : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                

                $checkJadwal = Jadwal::where('periode_id', $request->periode_id)->where('tipe',$request->tipe)->first();
                $currentJadwal = Jadwal::where('id', $id)->where('tipe',$request->tipe)->first();

                if($checkJadwal && !$currentJadwal) return response()->json(['status'=>'failed','message'=>'Tipe jadwal yang sama telah tersedia.'],400);

                Jadwal::where('id',$id)->update([
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'tipe' => $request->tipe,
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
        DB::beginTransaction();

        try {
            $checkPeriode = Jadwal::where('jadwal.id',$id)->leftJoin('periode', 'jadwal.periode_id', 'periode.id')->first(['status']);
            if($checkPeriode?->status === "selesai") return response()->json(['status'=>'warning','message'=>'Tidak dapat dihapus, periode telah selesai.'],400);

            Jadwal::find($id)->delete();

            DB::commit();
            return response()->json(['status'=>'success', 'message'=>'Berhasil dihapus.'],200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function datatable($id){
        // mengambil data
        $data = DB::table('jadwal')
                        ->where('periode_id',$id)
                        ->orderBy('created_at','DESC')
                        ->select(
                            'id',
                            'tanggal',
                            'jam',
                            'tipe'
                        )->get();

        return Datatables::of($data)->addIndexColumn()
            ->addIndexColumn()
            ->addColumn('tanggal', function ($data) {
                return $data->tanggal;
            })
            ->addColumn('jam', function ($data) {
                return $data->jam;
            })
            ->addColumn('tipe', function ($data) {
                return $data->tipe;
            })
            ->addColumn('action', function($data){
                return '
                    <a href="javascript:void(0)" data-toggle="tooltip" 
                        data-id="'.$data->id.'" 
                        data-tanggal="'.$data->tanggal.'" 
                        data-jam="'.$data->jam.'" 
                        data-tipe="'.$data->tipe.'" 
                        data-original-title="Edit" class="edit btn btn-primary btn-sm show-edit-modal"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm show-delete-modal"><i class="fas fa-trash-alt"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
