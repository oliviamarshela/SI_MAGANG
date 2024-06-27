<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\UnggahBerkas;
use App\Models\Periode;
use App\Models\Jadwal;
use App\Models\Laporan;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role === 'admin'){

            return view('home');
        }else if(Auth::user()->role === 'mhs'){
            $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
            $unggahBerkas = UnggahBerkas::where('user_id', Auth::id())->first();
            $periode = Periode::where('id',$pendaftaran?->periode_id)->first();

            $jadwalPembekalan = Jadwal::where('periode_id',$pendaftaran?->periode_id)->where('tipe','pembekalan')->first(['tanggal','jam']);
            $jadwalPelepasan = Jadwal::where('periode_id',$pendaftaran?->periode_id)->where('tipe','pelepasan')->first(['tanggal','jam']);
            $jadwalPenarikan = Jadwal::where('periode_id',$pendaftaran?->periode_id)->where('tipe','penarikan')->first(['tanggal','jam']);
            $jadwalUjian = Jadwal::where('periode_id',$pendaftaran?->periode_id)->where('tipe','ujian')->first(['tanggal','jam']);

            $laporan = Laporan::where('user_id',Auth::id())->first();

            return view('home', compact(
                'pendaftaran',
                'unggahBerkas',
                'periode',
                'jadwalPembekalan',
                'jadwalPelepasan',
                'jadwalPenarikan',
                'jadwalUjian',
                'laporan'
            ));
        }

    }
}
