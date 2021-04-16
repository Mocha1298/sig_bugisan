<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class Frontend extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fe.index');
    }
    public function peta()
    {
        $jenis = DB::table('jenis')->get();
        return view('fe.peta.peta',['jenis'=>$jenis]);
    }
    public function datapeta()
    {
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->join('foto_kerusakan', 'detail.Id_Detail', '=', 'foto_kerusakan.Id_Detail')
        ->select('*')
        ->get();
        echo json_encode($data);
    }
    public function datapeta1()//DATAPETA DETAIL
    {
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->join('foto_kerusakan', 'detail.Id_Detail', '=', 'foto_kerusakan.Id_Detail')
        ->select('*')
        ->get();
        echo json_encode($data);
    }
    public function profile()
    {
        return view('fe.profile.profile');
    }

    public function kontak()
    {
        return view('fe.kontak.kontak');
    }

    public function data()
    {
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->join('foto_kerusakan', 'detail.Id_Detail', '=', 'foto_kerusakan.Id_Detail')
        ->select('*')
        ->get();
        $jenis = DB::table('jenis')->get();
        return view('fe.data.data',['data'=>$data,'jenis'=>$jenis]);
    }

    public function detail($Id_Kerusakan)
    {
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->join('foto_kerusakan', 'detail.Id_Detail', '=', 'foto_kerusakan.Id_Detail')
        ->select('*')
        ->where('kerusakan.Id_Kerusakan',$Id_Kerusakan)
        ->first();
        $komentar = DB::table('komentar')->get();
        $balasan = DB::table('balasan')->get();
        $jenis = DB::table('jenis')->get();
        return view('fe.data.detail',['data'=>$data,'komentar'=>$komentar,'balasan'=>$balasan,'jenis'=>$jenis]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function komentar(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'komentar'=>'required'
        ]);
        DB::table('komentar')->insert(
            ['komentar'=>$request->komentar,
            'Id_Detail'=>$request->Id_Detail,
            'email'=>$request->email]
        );
        
        $details = [
            'title' => 'Notifikasi Komentar SIG Bugisan',
            'body' => 'Komentar baru dari '.$request->email,
            'comment' => $request->komentar,
            'notice' => '127.0.0.1:8000/be/kerusakan/'.$request->Id_Kerusakan
        ];
        
        $admin = User::all();
        foreach ($admin as $key => $value) {
            \Mail::to($value->email)->send(new \App\Mail\SIGMAIL($details));
        }

        $details = [
            'title' => 'Notifikasi Komentar SIG Bugisan',
            'body' => 'Terima kasih telah memberikan komentar di sistem kami "SIG BUGISAN"',
            'comment' => 'Selalu pantau sistem kami untuk mengetahui setiap kerusakan baru dan balasan dari kami.',
            'notice' => '127.0.0.1:8000/fe/kerusakan/'.$request->Id_Kerusakan
        ];
        \Mail::to($request->email)->send(new \App\Mail\Masyarakat($details));

        return redirect('/fe/kerusakan/'.$request->Id_Kerusakan);
    }
    public function balas(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'komentar'=>'required'
        ]);
        $komentar = DB::table('komentar')->where('Id_Komentar',$request->Id_Komentar)->first();
        DB::table('balasan')->insert(
            ['komentar'=>$request->komentar,
            'Id_Komentar'=>$request->Id_Komentar,
            'email'=>$request->email]
        );

        $details = [
            'title' => 'Notifikasi Balasan SIG Bugisan',
            'body' => 'Balasan baru dari '.$request->email,
            'comment' => $request->komentar,
            'notice' => '127.0.0.1:8000/fe/kerusakan/'.$request->Id_Kerusakan
        ];
        
        \Mail::to($komentar->email)->send(new \App\Mail\SIGMAIL($details));

        return redirect('/fe/kerusakan/'.$request->Id_Kerusakan);
    }
}
