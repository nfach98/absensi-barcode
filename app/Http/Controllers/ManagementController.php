<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Auth;

class ManagementController extends Controller
{
    public function index()
    {
    	$masuk = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_masuk", DB::raw("CONCAT(DAY(dataAbsensi.jam_absen), ' ', users.name) AS concatenated"))
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->where([
            ['dataAbsensi.jam_absen', '>=', date('Y-m-d')],
            ['dataAbsensi.jam_absen', '<', date('Y-m-d', strtotime("+1 day"))],
        ])
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('concatenated');

        $id_masuk = Absensi::select("dataAbsensi.id", DB::raw("CONCAT(DAY(dataAbsensi.jam_absen), ' ', users.name) AS concatenated"))
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->where([
            ['dataAbsensi.jam_absen', '>=', date('Y-m-d')],
            ['dataAbsensi.jam_absen', '<', date('Y-m-d', strtotime("+1 day"))],
        ])
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('concatenated');

        $ids = [];
        foreach($id_masuk as $idm) {
            array_push($ids, $idm->id);
        }

        $pulang = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_pulang", DB::raw("CONCAT(DAY(dataAbsensi.jam_absen), ' ', users.name) AS concatenated"))
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->where([
            ['dataAbsensi.jam_absen', '>=', date('Y-m-d')],
            ['dataAbsensi.jam_absen', '<', date('Y-m-d', strtotime("+1 day"))],
        ])
        ->whereNotIn('dataAbsensi.id', $ids)
        ->orderBy('dataAbsensi.jam_absen', 'desc')
        ->get()
        ->unique('concatenated');
        $pulang = $pulang->reverse();

        return view('management', ["masuk" => $masuk, "pulang" => $pulang]);
    }

    public function getAbsensi(Request $request){
        $masuk = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_masuk", DB::raw("CONCAT(DAY(dataAbsensi.jam_absen), ' ', users.name) AS concatenated"))
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->where([
            ['dataAbsensi.jam_absen', '>=', date('Y-m-d')],
            ['dataAbsensi.jam_absen', '<', date('Y-m-d', strtotime("+1 day"))],
        ])
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('concatenated');

        $id_masuk = Absensi::select("dataAbsensi.id", DB::raw("CONCAT(DAY(dataAbsensi.jam_absen), ' ', users.name) AS concatenated"))
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->where([
            ['dataAbsensi.jam_absen', '>=', date('Y-m-d')],
            ['dataAbsensi.jam_absen', '<', date('Y-m-d', strtotime("+1 day"))],
        ])
        ->orderBy('dataAbsensi.jam_absen', 'asc')
        ->get()
        ->unique('concatenated');

        $ids = [];
        foreach($id_masuk as $idm) {
            array_push($ids, $idm->id);
        }

        $pulang = Absensi::select("dataAbsensi.id", "dataAbsensi.suhu_badan", "dataAbsensi.jam_absen", "users.name", "users.email", "users.foto", "users.jabatan", "users.phone", "users.location", "shifts.name AS shift", "shifts.jam_pulang", DB::raw("CONCAT(DAY(dataAbsensi.jam_absen), ' ', users.name) AS concatenated"))
        ->join('users', 'users.id', '=', 'dataAbsensi.id_pegawai')
        ->join('shifts', 'shifts.id', '=', 'users.id_shift')
        ->where([
            ['dataAbsensi.jam_absen', '>=', date('Y-m-d')],
            ['dataAbsensi.jam_absen', '<', date('Y-m-d', strtotime("+1 day"))],
        ])
        ->whereNotIn('dataAbsensi.id', $ids)
        ->orderBy('dataAbsensi.jam_absen', 'desc')
        ->get()
        ->unique('concatenated');
        $pulang = $pulang->reverse();

        return ["masuk" => $masuk, "pulang" => $pulang];
    }}
