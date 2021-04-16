<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use File;
use Image;

class Backend extends Controller
{
    public function jos()
    {
        return view('be/layout/main');
    }
    // DASHBOARD
    public function dashboard()//HALAMAN DASHBOARD
    {
        $tringan = 'Ringan'; $tsedang = 'Sedang'; $tberat = 'Berat';
        $total = DB::table('kerusakan')->count();
        $ringan = DB::table('detail')->where('Level_Kerusakan',$tringan)->count();
        $sedang = DB::table('detail')->where('Level_Kerusakan',$tsedang)->count();
        $berat = DB::table('detail')->where('Level_Kerusakan',$tberat)->count();
        return view('be.dashboard.dashboard',['total'=>$total,'ringan'=>$ringan,'sedang'=>$sedang,'berat'=>$berat,'tringan'=>$tringan,
        'tsedang'=>$tsedang, 'tberat'=>$tberat]);
    }


    // Master Jenis Kerusakan
    public function jenis_kerusakan()//Get halaman master
    {
        $jenis = DB::table('jenis')->get();
        return view('be.master.jenis_kerusakan',['jenis'=>$jenis]);
    }
    public function tambah_jenis(Request $req)
    {
        $req->validate([
            'Jenis_Kerusakan'=> 'required|unique:jenis'
        ]);
        DB::table('jenis')
        ->insert([
            'Jenis_Kerusakan' => $req->Jenis_Kerusakan
            ]);
        return redirect("/be/jenis_kerusakan")->with('sukses','Data berhasil disimpan.');
    }
    public function post_edit_jenis(Request $req,$Id_Jenis)
    {
        $u = DB::table('jenis')->where('Id_Jenis',$Id_Jenis)->first();
        $req->validate([
            'Jenis_Kerusakan'=> 'required|unique:jenis,Jenis_Kerusakan,'.$u->Id_Jenis.',Id_Jenis'
        ]);
        DB::table('jenis')
        ->where('Id_Jenis', $Id_Jenis)
        ->update([
            'Jenis_Kerusakan' => $req->Jenis_Kerusakan,
            ]);
        return redirect("/be/jenis_kerusakan")->with('ubah','Data berhasil diubah.');
    }
    public function delete_jenis($Id_Jenis)
    {
        DB::table('jenis')->where('Id_Jenis',$Id_Jenis)->delete();
        return redirect("/be/jenis_kerusakan")->with('hapus','Data berhasil diubah.');
    }


    // PETA
    public function peta()//HALAMAN PETA
    {
        $jenis = DB::table('jenis')->get();
        return view('be.peta.peta',['jenis'=>$jenis]);
    }
    public function datapeta(Request $req)//DATAPETA
    {
        // if (empty($req)){
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->join('foto_kerusakan', 'detail.Id_Detail', '=', 'foto_kerusakan.Id_Detail')
        ->select('*')
        ->get();
        echo json_encode($data);
    }
    public function tambah_peta($Garis_Bujur, $Garis_Lintang)
    {
        $Garis_Bujur =  $Garis_Bujur;
        $Garis_Lintang = $Garis_Lintang;
        $jenis = DB::table('jenis')->get();
        return view('be.peta.tambah_data',['Garis_Bujur'=>$Garis_Bujur,'Garis_Lintang'=>$Garis_Lintang,'jenis'=>$jenis]);
    }
    public function post_peta(Request $request)
    {
        $request->validate([
            'Nama_Tempat' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'Garis_Bujur' => 'required',
            'Garis_Lintang' => 'required',
            'Jenis_Kerusakan' => 'required',
            'Level_Kerusakan' => 'required',
            'Tahun_Perbaikan' => 'required',
            'Manfaat' => 'required',
            'Jenis_Perbaikan' => 'required',
            'Foto1' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        if($request->hasFile('Foto1')){
            $file = $request->file('Foto1');
            $eks = $file->getClientOriginalExtension();
            $imgname ='kerusakan_'.time().'.'.$eks;
            $img = Image::make($file->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save('be_aset/dist/img/kerusakan/'.$imgname);
        } else {
            $imgname = 'empty.jpg';
        }

        $user = DB::table('users')->where('name',$request->id)->first();
        $id = $user->id;

        DB::table('kerusakan')->insert(
            ['Nama_Tempat' => $request->Nama_Tempat,
             'RT' => $request->RT,
             'RW'=>$request->RW,
             'Garis_Bujur'=>$request->Garis_Bujur,
             'Garis_Lintang'=>$request->Garis_Lintang,
             'Id_User'=>$id
            ]
        );

        $kerusakan = DB::table('kerusakan')->max('Id_Kerusakan');

        DB::table('detail')->insert(
            [
             'Id_jenis'=>$request->Jenis_Kerusakan,
             'Level_Kerusakan'=>$request->Level_Kerusakan,
             'Status'=>'Rencana',
             'Tahun_Perbaikan'=>$request->Tahun_Perbaikan,
             'Manfaat'=>$request->Manfaat,
             'Jenis_Perbaikan'=>$request->Jenis_Perbaikan,
             'Id_Kerusakan'=>$kerusakan
            ]
        );

        $detail = DB::table('detail')->max('Id_Detail');

        DB::table('foto_kerusakan')->insert(
            [
            'Id_Detail'=>$detail,
            'Foto1'=>$imgname
            ]
        );

        return redirect('/be/peta')->with('sukses','Data berhasil ditambahkan!');
    }


    // KERUSAKAAAANNN
    public function kerusakan()//GET HALAMAN KERUSAKAN
    {
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->select('*')
        ->get();
        $jenis = DB::table('jenis')->get();
        return view('be.data_kerusakan.tabel_kerusakan',['data'=>$data,'jenis'=>$jenis]);
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
    public function detail_kerusakan($Id_Kerusakan)//GET HALAMAN DETAIL KERUSAKAN
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
        return view('be.data_kerusakan.detail',['data'=>$data,'komentar'=>$komentar,'balasan'=>$balasan,'jenis'=>$jenis]);
    }
    public function balas(Request $req)
    {
        $req->validate([
            'komentar'=>'required'
        ]);
        $email = DB::table('users')->where('name',$req->email)->first();
        DB::table('balasan')->insert(
            ['komentar'=>$req->komentar,
            'Id_Komentar'=>$req->Id_Komentar,
            'email'=>$email->email]
        );

        $komentar = DB::table('komentar')->where('Id_Komentar',$req->Id_Komentar)->first();

        $details = [
            'title' => 'Notifikasi Balasan SIG Bugisan',
            'body' => 'Balasan baru dari Admin',
            'comment' => $req->komentar,
            'notice' => '127.0.0.1:8000/fe/kerusakan/'.$req->Id_Kerusakan
        ];
        
        \Mail::to($komentar->email)->send(new \App\Mail\SIGMAIL($details));

        return redirect('/be/kerusakan/'.$req->Id_Kerusakan);

    }
    public function tambah()//GET HALAMAN TAMBAH DATA KERUSAKAN
    {
        $jenis = DB::table('jenis')->get();
        return view('be.data_kerusakan.tambah_data',['jenis'=>$jenis]);
    }
    public function proses_tambah_data(Request $request)//POST TAMBAH DATA KERUSAKAN
    {
        $request->validate([
            'Nama_Tempat' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'Garis_Bujur' => 'required',
            'Garis_Lintang' => 'required',
            'Jenis_Kerusakan' => 'required',
            'Level_Kerusakan' => 'required',
            'Tahun_Perbaikan' => 'required',
            'Manfaat' => 'required',
            'Jenis_Perbaikan' => 'required',
            'Foto1' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        if($request->hasFile('Foto1')){
            $file = $request->file('Foto1');
            $eks = $file->getClientOriginalExtension();
            $imgname ='kerusakan_'.time().'.'.$eks;
            $img = Image::make($file->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save('be_aset/dist/img/kerusakan/'.$imgname);
        } else {
            $imgname = 'empty.jpg';
        }

        $user = DB::table('users')->where('name',$request->id)->first();
        $id = $user->id;

        DB::table('kerusakan')->insert(
            ['Nama_Tempat' => $request->Nama_Tempat,
             'RT' => $request->RT,
             'RW'=>$request->RW,
             'Garis_Bujur'=>$request->Garis_Bujur,
             'Garis_Lintang'=>$request->Garis_Lintang,
             'Id_User'=>$id
            ]
        );

        $kerusakan = DB::table('kerusakan')->max('Id_Kerusakan');

        DB::table('detail')->insert(
            [
             'Id_Jenis'=>$request->Jenis_Kerusakan,
             'Level_Kerusakan'=>$request->Level_Kerusakan,
             'Status'=>'Rencana',
             'Tahun_Perbaikan'=>$request->Tahun_Perbaikan,
             'Manfaat'=>$request->Manfaat,
             'Jenis_Perbaikan'=>$request->Jenis_Perbaikan,
             'Id_Kerusakan'=>$kerusakan
            ]
        );

        $detail = DB::table('detail')->max('Id_Detail');

        DB::table('foto_kerusakan')->insert(
            [
            'Id_Detail'=>$detail,
            'Foto1'=>$imgname
            ]
        );

        return redirect('/be/kerusakan')->with('sukses','Data berhasil ditambahkan!');
    }
    public function ubah_all_data($Id_Kerusakan)//GET HALAMAN UBAH SEMUA DATA KERUSAKAN
    {
        $data = DB::table('kerusakan')
        ->join('detail', 'kerusakan.Id_Kerusakan', '=', 'detail.Id_Kerusakan')
        ->join('foto_kerusakan', 'detail.Id_Detail', '=', 'foto_kerusakan.Id_Detail')
        ->select('*')
        ->where('kerusakan.Id_Kerusakan',$Id_Kerusakan)
        ->first();
        $jenis = DB::table('jenis')->get();
        return view('be.data_kerusakan.ubah_all_data',['data'=>$data,'jenis'=>$jenis]);
    }
    public function proses_ubah_all_data(Request $request)//POST UBAH SEMUA DATA
    {
        $request->validate([
            'Nama_Tempat' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'Garis_Bujur' => 'required',
            'Garis_Lintang' => 'required',
            'Jenis_Kerusakan' => 'required',
            'Level_Kerusakan' => 'required',
            'Tahun_Perbaikan' => 'required',
            'Manfaat' => 'required',
            'Jenis_Perbaikan' => 'required',
            'Foto1' => 'mimes:jpg,png,jpeg,gif,svg',
            'Foto2' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);
        if ($request->Status=='Rencana') {
            $imgname0;
            if($request->hasFile('Foto1')){
                //Memindah Foto baru
                $file = $request->file('Foto1');
                $eks = $file->getClientOriginalExtension();
                $imgname0 ='kerusakan_'.time().'.'.$eks;
                $img = Image::make($file->getRealPath());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('be_aset/dist/img/kerusakan/'.$imgname0);
                //HAPUS FOTO LAMA
                $foto = DB::table('foto_kerusakan')->where('Id_Detail',$request->det)->first();//
                $foto1 = $foto->Foto1;
                $hapus1 = "be_aset/dist/img/kerusakan/$foto1";
                if(File::exists($hapus1)) {
                    if($foto1 != "empty.jpg"){
                        File::delete($hapus1);
                    }
                }
            } else {
                $imgname0 = $request->foto_1;
            }
            DB::table('foto_kerusakan')
            ->where('Id_Detail', $request->det)
            ->update([
                'Foto1' => $imgname0,
                ]);
        } 
        elseif($request->Status=='Selesai'){
            $imgname1;
            $imgname2;
            $foto = DB::table('foto_kerusakan')->where('Id_Detail',$request->det)->first();
            if($request->hasFile('Foto1')){
                $file1 = $request->file('Foto1');
                $eks = $file1->getClientOriginalExtension();
                $imgname1 ='kerusakan_'.time().'.'.$eks;
                $img1 = Image::make($file1->getRealPath());
                $img1->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('be_aset/dist/img/kerusakan/'.$imgname1);
                $foto1 = $foto->Foto1;
                $hapus1 = "be_aset/dist/img/kerusakan/".$foto1;
                if(File::exists($hapus1)) {
                    if($foto1 != "empty.jpg"){
                        File::delete($hapus1);
                    }
                }
            } else {
                $imgname1 = $request->foto_1;
            }
            if($request->hasFile('Foto2')){
                $file2 = $request->file('Foto2');
                $eks = $file2->getClientOriginalExtension();
                $imgname2 ='perbaikan_'.time().'.'.$eks;
                $img2 = Image::make($file2->getRealPath());
                $img2->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('be_aset/dist/img/kerusakan/'.$imgname2);
                //HAPUS FOTO UBAH
                $foto = DB::table('foto_kerusakan')->where('Id_Detail',$request->det)->first();//
                $foto2 = $foto->Foto2;
                $hapus2 = "be_aset/dist/img/kerusakan/".$foto2;
                if(File::exists($hapus2)) {
                    if($foto2 != "empty.jpg"){
                        File::delete($hapus2);
                    }
                }
            } else {
                $imgname2 = $request->foto_2;
            }
            DB::table('foto_kerusakan')
            ->where('Id_Detail', $request->det)
            ->update([
                'Foto1' => $imgname1,
                'Foto2' => $imgname2
                ]);
        }
        DB::table('kerusakan')
            ->where('Id_Kerusakan', $request->rusak)
            ->update([
                'Nama_Tempat' => $request->Nama_Tempat,
                'RT' => $request->RT,
                'RW' => $request->RW,
                'Garis_Bujur' => $request->Garis_Bujur,
                'Garis_Lintang' => $request->Garis_Lintang,
                ]);
        DB::table('detail')
            ->where('Id_Detail', $request->det)
            ->update([
                'Id_Jenis' => $request->Jenis_Kerusakan,
                'Level_Kerusakan' => $request->Level_Kerusakan,
                'Tahun_Perbaikan' => $request->Tahun_Perbaikan,
                'Jenis_Perbaikan' => $request->Jenis_Perbaikan,
                'Manfaat' => $request->Manfaat,
                ]);
        return redirect("/be/kerusakan/".$request->rusak)->with('ubah','Data berhasil diubah.');
    }
    public function proses_ubah_status(Request $request)//POST UBAH STATUS
    {
        if ($request->Status=='Rencana') {
            DB::table('detail')
            ->where('Id_Detail', $request->det)
            ->update([
                'Status' => 'Rencana'
            ]);
            //HAPUS FOTO UBAH
            $foto = DB::table('foto_kerusakan')->where('Id_Detail',$request->det)->first();//
            $foto2 = $foto->Foto2;
            $hapus2 = "be_aset/dist/img/kerusakan/$foto2";
            if(File::exists($hapus2)) {
                if($foto2 != "empty.jpg"){
                    File::delete($hapus2);
                }
            }
        }
        elseif($request->Status=='Selesai'){
            $imgname = 'empty.jpg';
            DB::table('detail')
            ->where('Id_Detail', $request->det)
            ->update([
                'Status' => 'Selesai'
            ]);
            DB::table('foto_kerusakan')
            ->where('Id_Detail', $request->det)
            ->update([
                'Foto2' => $imgname,
                ]);
        }
        else{
            DB::table('detail')
            ->where('Id_Detail', $request->det)
            ->update([
                'Status' => 'Sedang'
            ]);
        }
        return redirect()->back()->with('ubah','Status berhasil diubah.');
    }
    public function hapus_data($Id_Kerusakan)//POST HAPUS DATA
    {
        $detail = DB::table('detail')->where('Id_Kerusakan',$Id_Kerusakan)->first();
        $foto = DB::table('foto_kerusakan')->where('Id_Detail',$detail->Id_Detail)->first();
        $foto1 = $foto->Foto1;
        $foto2 = $foto->Foto2;
        $hapus1 = "be_aset/dist/img/kerusakan/$foto1";
        $hapus2 = "be_aset/dist/img/kerusakan/$foto2";
        if(File::exists($hapus1) && File::exists($hapus2)) {
            if($foto1 != "empty.jpg"){
                File::delete($hapus1);
            }
            elseif($foto2 != "empty.jpg"){
                File::delete($hapus2);
            }
        }
        DB::table('foto_kerusakan')->where('Id_Detail',$detail->Id_Detail)->delete();//mengehapus foto
        DB::table('detail')->where('Id_Detail',$detail->Id_Detail)->delete();//menghapus detail
        DB::table('kerusakan')->where('Id_Kerusakan',$Id_Kerusakan)->delete();//menghapus kerusakan
        return redirect('/be/kerusakan')->with('hapus','Data berhasil dihapus.');
    }
    


    // Admin
    public function admin()//GET HALAMAN TABEL ADMIN
    {
        $user = DB::table('users')->get();
        return view('be.data_user.tabel_user',['user'=>$user]);
    }
    public function tambah_admin()//GET HALAMAN TAMBAH USER
    {
        return view('be.data_user.tambah_user');
    }
    public function proses_tambah_admin(Request $request)//POST TAMBAH USER
    {
        $request->validate([

            'name' => 'required|min:2|max:50',          

            'email' => 'required|email|unique:users',

            'password' => 'required|min:6',                

            'password_confirmation' => 'required|min:6|max:20|same:password',

        ]);

        $input = request()->except('password','confirm_password');

        $user=new User($input);

        $user->password=bcrypt(request()->password);

        $user->save();

        return redirect('/be/admin')->with('sukses','Data berhasil ditambahkan.');
    }
    public function ubah_admin($id)
    {
        $user = DB::table('users')->where('id',$id)->first();
        return view('be.data_user.ubah_user',['user'=>$user]);
    }
    public function proses_ubah_admin(Request $request)
    {
        $u = User::find($request->id);
        $request->validate([

            'name' => 'required|min:2|max:50',          
        
            'email' => 'required|email|unique:users,email,'.$u->id.',id', 
        
        ]);
        
        $u->update([
            'name' => $request->name,
            'email' => $request->email,
            ]);
        
        return redirect('/be/admin')->with('ubah','Data berhasil diubah.');
    }
}