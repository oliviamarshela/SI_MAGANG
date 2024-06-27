<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanAdminController extends Controller
{

    public function index()
    {
        $laporan = Laporan::leftJoin('pendaftaran', 'laporan.pendaftaran_id', 'pendaftaran.id')
                            ->leftJoin('users', 'laporan.user_id', 'users.id')
                            ->leftJoin('periode', 'pendaftaran.periode_id', 'periode.id')
                            ->orderBy('laporan.created_at','DESC')
                            ->get([
                                'laporan.id',
                                'users.name as nama_mhs',
                                'users.nim',
                                'periode.nama as periode',
                                'laporan.file',
                                'laporan.keterangan',
                                'laporan.updated_at'
                            ]);
        // dd($laporan);

        return view('pages.laporan.index', compact('laporan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
