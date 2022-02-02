<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Auth;

class RecapController extends Controller
{
    public function index($date)
    {
        $month = explode("-",$date)[0];
        $year = explode("-",$date)[1];

    	$masuk = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_masuk")
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->whereYear('dataAbsensi.jam_absen', $year)
        ->whereMonth('dataAbsensi.jam_absen', $month)
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('dataAbsensi.id_pegawai');

        $id_masuk = Absensi::select("dataAbsensi.id")
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->whereYear('dataAbsensi.jam_absen', $year)
        ->whereMonth('dataAbsensi.jam_absen', $month)
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('dataAbsensi.id_pegawai');

        $pulang = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_pulang")
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->whereYear('dataAbsensi.jam_absen', $year)
        ->whereMonth('dataAbsensi.jam_absen', $month)
        ->whereNotIn('dataAbsensi.id', $id_masuk)
        ->orderBy('dataAbsensi.jam_absen', 'desc')
        ->get()
        ->unique('dataAbsensi.id_pegawai');

        return view('recap', ["masuk" => $masuk, "pulang" => $pulang, "date" => $date]);
    }

    public function getRecap(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $masuk = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_masuk")
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->whereYear('dataAbsensi.jam_absen', $year)
        ->whereMonth('dataAbsensi.jam_absen', $month)
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('dataAbsensi.id_pegawai');

        $id_masuk = Absensi::select("dataAbsensi.id")
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->whereYear('dataAbsensi.jam_absen', $year)
        ->whereMonth('dataAbsensi.jam_absen', $month)
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('dataAbsensi.id_pegawai');

        $pulang = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_pulang")
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->whereYear('dataAbsensi.jam_absen', $year)
        ->whereMonth('dataAbsensi.jam_absen', $month)
        ->whereNotIn('dataAbsensi.id', $id_masuk)
        ->orderBy('dataAbsensi.jam_absen', 'desc')
        ->get()
        ->unique('dataAbsensi.id_pegawai');

        return ["masuk" => $masuk, "pulang" => $pulang];
    }
}
