<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB, DataTables, Validator;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.user.index');
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
                'name' => 'required',
                'nim' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];
    
            $messages  = [
                'name.required' => 'Nama : Tidak boleh kosong.',
                'nim.required' => 'NIM : Tidak boleh kosong.',
                'nim.unique' => 'NIM : NIM telah digunakan.',
                'email.required' => 'Email : Tidak boleh kosong.',
                'email.email' => 'Email : Format email salah.',
                'email.unique' => 'Email : Email telah digunakan.',
                'password.required' => 'Password : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                 
                User::create([
                    'name' => $request->name,
                    'nim' => $request->nim,
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 'aktif',
                    'role' => 'mhs'
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

        // var_dump("check : ", $request->password);
        try {
            $rules = [
                'nim' => 'required|unique:users,nim,' .$id,
                'email' => 'required|email|unique:users,email,' .$id,
                'name' => 'required',
                'status' => 'required',
            ];

            $messages  = [
                'nim.required' => 'NIM : Tidak boleh kosong.',
                'nim.unique' => 'NIM : NIM telah digunakan.',
                'email.required' => 'Email : Tidak boleh kosong.',
                'email.email' => 'Email : Format email salah.',
                'email.unique' => 'Email : Email telah digunakan.',
                'name.required' => 'Nama : Tidak boleh kosong.',
                'status.required' => 'Status : Tidak boleh kosong.',
            ];
            
            if($request->password){
                $rules += ['password' => 'required'];
                $messages += ['password.required' => 'Password : Tidak boleh kosong.',];
            }

            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                
                $data = [
                    'nim' => $request->nim,
                    'email' => $request->email,
                    'name' => $request->name,
                    'status' => $request->status,
                ];

                if($request->password) $data += ['password' => bcrypt($request->password)];

                User::where('id',$id)->update($data);
    
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

    public function datatable(){
        // mengambil data
        $userList = DB::table('users')
                        ->where('role','mhs')
                        ->orderBy('created_at', 'DESC')
                        ->select(
                            'id',
                            'name',
                            'email',
                            'nim',
                            'status'
                        )->get();

        return Datatables::of($userList)->addIndexColumn()
            ->addIndexColumn()
            ->addColumn('name', function ($userList) {
                return $userList->name;
            })
            ->addColumn('email', function ($userList) {
                return $userList->email;
            })
            ->addColumn('nim', function ($userList) {
                return $userList->nim;
            })
            ->addColumn('status', function ($userList) {
                if($userList->status === 'aktif') return '<h6><span class="badge badge-success">Aktif</span></h6>';
                else if($userList->status === 'tidak-aktif') return '<h6><span class="badge badge-danger">Tidak Aktif</span></h6>';
            })
            ->addColumn('action', function($userList){
                return '
                    <a href="javascript:void(0)" data-toggle="tooltip"
                        data-id="'.$userList->id.'" 
                        data-name="'.$userList->name.'" 
                        data-nim="'.$userList->nim.'" 
                        data-email="'.$userList->email.'" 
                        data-status="'.$userList->status.'" 
                        data-original-title="Edit" class="edit btn btn-primary btn-sm show-edit-modal"><i class="fas fa-edit"></i></a>
                ';
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}
