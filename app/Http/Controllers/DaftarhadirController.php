<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Config;
use App\Models\Daftarhadir;
use App\Models\asesor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDaftarhadirRequest;
use App\Http\Requests\UpdateDaftarhadirRequest;

class DaftarhadirController extends Controller
{
    public function index(Request $request, $link)
    {
        // load config form
        $datanya = Config::where('link', $link)->first();
        $judul = $datanya->judul;
        $link = $datanya->link;
        $kategori = "<input type='hidden' name='kat_dh' id='kat_dh' value='" . $datanya->kategori . "'>";
        #sampai sini
        $mytime = Carbon::now('Asia/Jakarta');
        //field variables
        //form category
        $kat = $datanya->kategori;

        $compact = array('unit', 'theads', 'judul', 'kategori', 'form', 'link', 'kat');
        $isi = explode(",", $datanya->tabel);
        $konten = $isi;
        //date today
        $today = $mytime->format('d-m-Y');
        if (in_array("nama_asesor", $isi)) {
            unset($isi[0]);
            array_unshift($isi, 'nama');
            array_unshift($isi, 'nia');
            array_push($isi, 'created_at');
            // dd($isi);

            $ass =
            asesor::where([
                ['judul', '=', $kat],
                    ['soft_delete', '=', 0],
                    // Add more conditions here if needed
                ])->get();
            array_unshift($compact, 'ass');

            $data = Daftarhadir::with('nia_asesor')
                ->where(
                [
                    ['kat_dh', '=', $datanya->kategori],
                    ['tanggal', '=', $today]
                ]
                )
                ->orderBy('created_at', 'DESC')->get();
        } else {
            $data = Daftarhadir::where(
                [
                ['kat_dh', '=', $datanya->kategori],
                    ['tanggal', '=', $today]
                ]
            )
                ->orderBy('created_at', 'DESC')->get();
            $ass = null;
            array_unshift($compact, 'ass');
        }
        //table head lists
        $theads = $isi;
        //array_unshift() is for append value to the first queue/array, array_shift() is the opposite 
        array_unshift($theads, 'No.');

        //declarate datatable columns
        $unit = $isi;
        array_unshift($unit, 'DT_RowIndex');

        // dd($unit);
        $form = Form::select('tag_field')
            ->whereIn("nama_field", $konten)
            ->get();
        

        //load yajra datatable
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('nia', function ($data) {
                //     return $data->nia_asesor->nia;
                // })
                // ->addColumn('nama', function ($data) {
                //     return $data->nia_asesor->nama;
                // })
                //     $ttd = $data->ttd;
                //     return '<img width="100" src="'.base_url().'app/public/' . $ttd . '" alt="">';
                // })
                // ->addColumn('aksi', function ($data) {
                //     $url = Crypt::encrypt($data->id);
                //     return '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-info show-btn"> Edit</a>';
                // })
                // ->rawColumns(['ttd'])
                ->make(true);
        }
        // dd($ass);
        return view('daftarhadir.form', compact($compact));
    }
    public function listForm(Request $request)
    {



        $search = $request->search;

        if ($search == '') {
            $lists = Form::select('nama_field')->get();
        } else {
            $lists = Form::select('nama_field')->where('nama_field', 'like', '%' . $search . '%')->limit(20)->get();
        }

        $response = array();
        foreach ($lists as $list) {
            $response[] = array(
                "id" => $list->nama_field,
                "text" => $list->nama_field
            );
        }
        return response()->json($response);
    }
    // show form page parsed from dynamic URL
    public function show(Request $request, $link)
    {
        // $datanya = Config::where('link', $link)->first();
        $id = $request->id;
        $decid = Crypt::decrypt($id);        // dd($decid);
        $where = array('id' => $decid);
        $unit = Daftarhadir::where($where)->first();
        return response()->json($unit);
    }

    //load config page
    public function config(Request $request)
    {
        //
        $forms = Form::all();
        $confs = Config::all();

        $tittle = "uji select2";
        $data = Config::where('id', '1')->first();
        
        $newdata = explode(",", $data->tabel);
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($confs)
                ->addIndexColumn()
                // ->addColumn('nia', function ($data) {
                //     return $data->nia_asesor->nia;
                // })
                // ->addColumn('nama', function ($data) {
                //     return $data->nia_asesor->nama;
                // })
                //     $ttd = $data->ttd;
                //     return '<img width="100" src="'.base_url().'app/public/' . $ttd . '" alt="">';
                // })
                ->addColumn('aksi', function ($data) {
                    $url = Crypt::encrypt($data->id);
                    $btn1 = '<a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-info show-btn"> Edit</a>';
                    $aksi = $btn1 . ' <a href="javascript:void(0)" data-id="' . $url . '" class="btn btn-danger del-btn"> Hapus</a>';
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('daftarhadir.config', compact('tittle', 'data', 'newdata', 'forms'));
    }

    // save the config page
    public function set_config(Request $request)
    {
        //
        if ($request->tabel) {
            $tabel = str_replace(" ", "", $request->tabel);
            $newdata = implode("),(", $tabel);
            $unit = Config::updateOrCreate(
                ['id' => 1],
                [
                    "tabel" => $newdata,
                    "kategori" => $request->kat,
                    "link" => $request->link,
                    "judul" => $request->judul,
                ]
            );
        } else {
            $unit = Config::updateOrCreate(
                ['id' => 1],
                [
                    "kategori" => $request->kat,
                    "link" => $request->link,
                    "judul" => $request->judul,
                ]
            );
        }
        $tabel = str_replace(" ", "", $request->tag);
        $newdata = implode("),(", $tabel);
        $unit = Config::updateOrCreate(
            ['id' => 1],
            [
                "tabel" => $newdata,
                "kategori" => $request->kat,
                "link" => $request->link,
                "judul" => $request->judul,
            ]
        );
        return response()->json($unit);
    }
    public function dhtable(Request $request)
    {
        $tittle = 'Daftar Hadir';
        $data = Daftarhadir::all();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('ttd', function ($data) {
                    $ttd = $data->ttd;
                    return '<img width="100" src="storage/app/public/' . $ttd . '" alt="">';
                })
                ->rawColumns(['ttd'])
                ->make(true);
        }
        // dd($form);
        return view('absen.daftar_hadir', compact('tittle'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    
    public function view(Request $request)
    {
        $tittle = "list daftar hadir";
        $theads = array('No', 'id', 'Nama', 'NIA', 'Kelas', 'Kab./Kota', 'Kat DH', 'TTD');
        $data = Daftarhadir::where('kat_dh', "Klasifikasi Permohonan Akreditasi (KPA) Tahap I")
            // ->orWhere('kode_kat',23)
            // ->orWhere('kode_kat',24)
            ->get();
        // $data = Daftarhadir::whereLike('PPDA Tahap')->get();
        // $data = Daftarhadir::where('kode_kat',8)->get();
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tand', function ($data) {
                $cek =  Storage::disk('public') . $data->ttd;
                    if (!empty($data->ttd)) {
                        return '<img width="40" src="' . $cek . '" />';
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(['tand'])
                ->make(true);
        }
        return view('daftarhadir.daftar', compact('tittle', 'theads'));
    }

    // dd($form);
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDaftarhadirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $validator = $request->validate([            
        //     'fotorek' => 'file|mimes:pdf,PDF,jpg,jpeg,png|max:1028|nullable',
        //     'surat_tugas' => 'file|mimes:pdf,PDF|max:1028|nullable',
        //     'surat_sehat' => 'file|mimes:pdf,PDF|max:1028|nullable',
        //     'pernyataan' => 'file|mimes:pdf,PDF|max:1028|nullable',
        // ]);

        $mytime = Carbon::now('Asia/Jakarta');

        // if ($request->file('pernyataan')) {
        //     $file_nyata = $request->file('pernyataan');
        //     $extension_nyata = $file_nyata->getClientOriginalExtension();
        //     $filename_nyata = "surat_pernyataan/".time() . "_" . $nia . "_pernyataan." . $extension_nyata;
        //     $validator['pernyataan'] = $filename_nyata;
        //     // Storage::disk('public')->put($filename_nyata, $file_nyata);
        //     $file_nyata->storeAs('pernyataan', $filename_nyata);            
        // }

        // if ($request->file('surat_sehat')) {
        //     $file_sehat = $request->file('surat_sehat');
        //     $extension_sehat = $file_sehat->getClientOriginalExtension();
        //     $filename_sehat = "surat_sehat/".time() . "_" . $nia . "_surat_sehat." . $extension_sehat;
        //     $validator['surat_sehat'] = $filename_sehat;
        //     // Storage::disk('public')->put($filename_sehat, $file_sehat);
        //     $file_sehat->storeAs('surat_sehat', $filename_sehat);            
        // }

        // if ($request->file('surat_tugas')) {
        //     $file_tugas = $request->file('surat_tugas');
        //     $extension_tugas = $file_tugas->getClientOriginalExtension();
        //     $filename_tugas = "surat_tugas/".time() . "_" . $nia . "_surat_tugas." . $extension_tugas;
        //     $validator['surat_tugas'] = $filename_tugas;
        //     // Storage::disk('public')->put($filename_tugas, $file_tugas);
        //     $file_tugas->storeAs('surat_tugas', $filename_tugas);            
        // }
        // if ($request->file('fotorek')) {
        //     $file_fotorek = $request->file('fotorek');
        //     $extension_fotorek = $file_fotorek->getClientOriginalExtension();
        //     $filename_fotorek = "fotorek/".time() . "_" . $nia . "_fotorek." . $extension_fotorek;
        //     $validator['fotorek'] = $filename_fotorek;
        //     // Storage::disk('public')->put($filename_tugas,$filename_tugas);
        //     $file_fotorek->storeAs('fotorek', $filename_fotorek);            
        // }
        if ($request->nia_ass) {
            $nia = $request->nia_ass;
            $ass = asesor::where('nia', $nia)->first();
            $nama = $ass->nama;
            $kelas = $ass->kelas;
            $signature = $request->signature;
            $signatureFileName = uniqid() . '.png';
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $ttd = base64_decode($signature);
            $file = 'ttdKesanggupan/' . $signatureFileName;
            // file_put_contents($file, $ttd);
            Storage::disk('public')->put($file, $ttd);
            $unit = Daftarhadir::updateOrCreate(
                [

                    // fix this issue {
                    'kat_dh' => $request->kat_dh,
                    'nia' => $nia,
                    'nama' => $nama,
                    'hp' => $request->hp,
                    'kelas' => $kelas,
                    'ttd' => $file,
                    'tanggal' => $mytime->format('d-m-Y'),
                    'unit' => $request->unit,
                    'kabkota' => $request->asal,
                    'unsur' => $request->unsur,
                    'jabatan' => $request->jabatan,

                ]
            );
        } else {
            $signature = $request->signature;
            
            $signatureFileName = uniqid() . '.png';
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $ttd = base64_decode($signature);
            $file = 'ttdKesanggupan/' . $signatureFileName;
            // file_put_contents($file, $ttd);
            Storage::disk('public')->put($file, $ttd);
            $unit = Daftarhadir::updateOrCreate(
                [

                    // fix this issue {
                    'nama' => $request->nama,
                    'nia' => $request->nia,

                    // }
                    'ttd' => $file,
                    'hp' => $request->hp,
                    'tanggal' => $mytime->format('d-m-Y'),
                    'kabkota' => $request->asal,
                    'kat_dh' => $request->kat_dh,
                    'bidang' => $request->bidang,

                    // []=>$isi,
                    'npsn' => $request->npsn,
                    'nama_lembaga' => $request->nama_lembaga,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'nip' => $request->nip,
                    'pangkat' => $request->pangkat,
                    // 'kelas' => $request->kelas,
                    // 'npwp' => $request->npwp,
                    // 'norek' => $request->norek,
                    // 'fotorek'=>$filename_fotorek,
                    'unit' => $request->unit,
                    'unsur' => $request->unsur,
                    'jabatan' => $request->jabatan,
                    'alamat_kantor' => $request->alamat_kantor,
                    'alamat_rumah' => $request->alamat_rumah,
                    'kesanggupan' => $request->kesanggupan,
                    'kepulauan' => $request->kepulauan,
                    // 'surat_tugas'=>$filename_tugas,
                    // 'pernyataan'=>$filename_nyata,
                    // 'surat_sehat'=>$filename_sehat
                    // 'document' => $request->file('document')->store('dokumen/'.$parent->tahun.'/'.$parent->satker->namasatker.'/'.$parent->risk_code.'/tindakan-penanganan', 'public'),
                ]
            );
        }


        // dd($unit);
        return response()->json($unit);
    }
    public function kesediaan(Request $request)
    {
        #edit ini
        $datanya = Config::where('id', 2)->first();
        #edit ini
        $judul = "$datanya->judul";
        $link = "form/$datanya->link";
        $kategori = "<input type='hidden' name='kat_dh' id='kat_dh' value='" . $datanya->kategori . "'>";
        #sampai sini
        $mytime = Carbon::now('Asia/Jakarta');
        $isi = explode(",", $datanya->tabel);
        // dd($iv);

        $kat = $datanya->kategori;
        $theads = $isi;
        array_unshift($theads, 'No.');
        $unit = $isi;
        array_unshift($unit, 'DT_RowIndex');
        $form = Form::select('tag_field')
            ->whereIn("nama_field", $isi)
            ->get();
        $today = $mytime->format('d-m-Y');
        $data = Daftarhadir::where('kat_dh', $datanya->kategori)
            ->orderBy('created_at', 'DESC')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        // dd($form);
        return view('daftarhadir.form', compact('unit', 'theads', 'judul', 'kategori', 'form', 'link', 'kat'));
    }
    public function postkesediaan(Request $request)
    {
        //
        $validator = $request->validate([
            'fotorek' => 'file|mimes:pdf,PDF,jpg,jpeg,png,PNG|max:1028|nullable',
            'surat_tugas' => 'file|mimes:pdf,PDF|max:1028|nullable',
            'surat_sehat' => 'file|mimes:pdf,PDF|max:1028|nullable',
            'pernyataan' => 'file|mimes:pdf,PDF|max:1028|nullable',
        ]);
        $nia = $request->nia;

        if ($request->file('pernyataan')) {
            $file_nyata = $request->file('pernyataan');
            $extension_nyata = $file_nyata->getClientOriginalExtension();
            $filename_nyata = "surat_pernyataan/" . time() . "_" . $nia . "_pernyataan." . $extension_nyata;
            $validator['pernyataan'] = $filename_nyata;
            // Storage::disk('public')->put($filename_nyata, $file_nyata);
            $file_nyata->storeAs('pernyataan', $filename_nyata);
        }

        if ($request->file('surat_sehat')) {
            $file_sehat = $request->file('surat_sehat');
            $extension_sehat = $file_sehat->getClientOriginalExtension();
            $filename_sehat = "surat_sehat/" . time() . "_" . $nia . "_surat_sehat." . $extension_sehat;
            $validator['surat_sehat'] = $filename_sehat;
            // Storage::disk('public')->put($filename_sehat, $file_sehat);
            $file_sehat->storeAs('surat_sehat', $filename_sehat);
        }

        if ($request->file('surat_tugas')) {
            $file_tugas = $request->file('surat_tugas');
            $extension_tugas = $file_tugas->getClientOriginalExtension();
            $filename_tugas = "surat_tugas/" . time() . "_" . $nia . "_surat_tugas." . $extension_tugas;
            $validator['surat_tugas'] = $filename_tugas;
            // Storage::disk('public')->put($filename_tugas, $file_tugas);
            $file_tugas->storeAs('surat_tugas', $filename_tugas);
        }
        if ($request->file('fotorek')) {
            $file_fotorek = $request->file('fotorek');
            $extension_fotorek = $file_fotorek->getClientOriginalExtension();
            $filename_fotorek = "fotorek/" . time() . "_" . $nia . "_fotorek." . $extension_fotorek;
            $validator['fotorek'] = $filename_fotorek;
            // Storage::disk('public')->put($filename_tugas,$filename_tugas);
            $file_fotorek->storeAs('fotorek', $filename_fotorek);
        }

        $signature = $request->signature;
        $signatureFileName = uniqid() . '.png';
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $ttd = base64_decode($signature);
        $file = 'ttdKesanggupan/' . $signatureFileName;
        // file_put_contents($file, $ttd);
        Storage::disk('public')->put($file, $ttd);


        $mytime = Carbon::now('Asia/Jakarta');
        $unit = Daftarhadir::updateOrCreate(
            [
                // []=>$isi,
                'nia' => $nia,
                'ttd' => $file,
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'npwp' => $request->npwp,
                'norek' => $request->norek,
                'hp' => $request->hp,
                'fotorek' => $filename_fotorek,
                'tanggal' => $mytime->format('d-m-Y'),
                'kabkota' => $request->asal,
                'kat_dh' => $request->kat_dh,
                'unit' => $request->unit,
                'unsur' => $request->unsur,
                'jabatan' => $request->jabatan,
                'alamat_kantor' => $request->alamat_kantor,
                'alamat_rumah' => $request->alamat_rumah,
                'kesanggupan' => $request->kesanggupan,
                'kepulauan' => $request->kepulauan,
                'surat_tugas' => $filename_tugas,
                'pernyataan' => $filename_nyata,
                'surat_sehat' => $filename_sehat
                // 'document' => $request->file('document')->store('dokumen/'.$parent->tahun.'/'.$parent->satker->namasatker.'/'.$parent->risk_code.'/tindakan-penanganan', 'public'),
            ]
        );

        return response()->json($unit);
    }


    public function sesi1(Request $request)
    {
        #edit ini
        $datanya = Config::where('id', 3)->first();
        #edit ini
        $judul = "$datanya->judul";
        $link = "$datanya->link";
        $kategori = "<input type='hidden' name='kat_dh' id='kat_dh' value='" . $datanya->kategori . "'>";
        #sampai sini
        $mytime = Carbon::now('Asia/Jakarta');
        $isi = explode(",", $datanya->tabel);
        $kat = $datanya->kategori;
        $theads = $isi;
        array_unshift($theads, 'No.');
        $unit = $isi;
        array_unshift($unit, 'DT_RowIndex');
        $form = Form::select('tag_field')
            ->whereIn("nama_field", $isi)
            ->get();
        $today = $mytime->format('d-m-Y');
        $data = Daftarhadir::where('tanggal', $today)
            ->where('kat_dh', $datanya->kategori)
            ->orderBy('created_at', 'DESC')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        // dd($form);
        return view('daftarhadir.form', compact('unit', 'theads', 'judul', 'kategori', 'form', 'link', 'kat'));
    }

    public function postsesi1(Request $request)
    {
        //
        $datanya = Config::where('id', 3)->first();
        $isi = explode(",", $datanya->tabel);

        // foreach ($isi as $item) {
        //     $record['haah'] = $request->nama_lembaga;
        // }

        $mytime = Carbon::now('Asia/Jakarta');
        $nia = $request->nia;
        foreach ($isi as $item) {
            $is_file = array('pernyataan', 'surat_sehat', 'surat_tugas', 'fotorek');
            $record[$item] = $request->$item;
            foreach ($is_file as $check) {
                if ($item = $is_file) { // contoh : 3
                    // $record = ['file' => $item];
                    if ($request->file($item)) {
                        $file_ = '$file_' . $item;
                        $filename = '$filename_' . $item;
                        $extension = '$extension_' . $item;
                        $file_ = $request->file($item);
                        $extension = $file_->getClientOriginalExtension();
                        $filename = time() . "_" . $nia . "_" . $item . "." . $extension;
                        // Storage::disk('public')->put($filename_.$upld, $file_nyata);
                        // $file = request()->file('uploadFile');
                        // $file_->store('ujicoba', ['disk' => 'public']);
                        $file_->storeAs($item, $filename);
                        $record[$item] = $filename;
                        dd($filename);
                    }
                }
            }
        }
        $record['tanggal'] = $mytime->format('d-m-Y');
        // if ($request->file('pernyataan')) {
        //     $file_nyata = $request->file('pernyataan');
        //     $extension_nyata = $file_nyata->getClientOriginalExtension();
        //     $filename_nyata = "surat_pernyataan/" . time() . "_" . $nia . "_pernyataan." . $extension_nyata;
        //     $validator['pernyataan'] = $filename_nyata;
        //     // Storage::disk('public')->put($filename_nyata, $file_nyata);
        //     $file_nyata->storeAs('pernyataan', $filename_nyata);
        //     $record['pernyataan'] = $filename_nyata;
        // }

        // if ($request->file('surat_sehat')) {
        //     $file_sehat = $request->file('surat_sehat');
        //     $extension_sehat = $file_sehat->getClientOriginalExtension();
        //     $filename_sehat = "surat_sehat/" . time() . "_" . $nia . "_surat_sehat." . $extension_sehat;
        //     $validator['surat_sehat'] = $filename_sehat;
        //     // Storage::disk('public')->put($filename_sehat, $file_sehat);
        //     $file_sehat->storeAs('surat_sehat', $filename_sehat);
        //     $record['surat_sehat'] = $filename_sehat;
        // }

        // if ($request->file('surat_tugas')) {
        //     $file_tugas = $request->file('surat_tugas');
        //     $extension_tugas = $file_tugas->getClientOriginalExtension();
        //     $filename_tugas = "surat_tugas/" . time() . "_" . $nia . "_surat_tugas." . $extension_tugas;
        //     $validator['surat_tugas'] = $filename_tugas;
        //     // Storage::disk('public')->put($filename_tugas, $file_tugas);
        //     $file_tugas->storeAs('surat_tugas', $filename_tugas);
        //     $record['surat_tugas'] = $filename_tugas;
        // }
        // if ($request->file('fotorek')) {
        //     $file_fotorek = $request->file('fotorek');
        //     $extension_fotorek = $file_fotorek->getClientOriginalExtension();
        //     $filename_fotorek = "fotorek/" . time() . "_" . $nia . "_fotorek." . $extension_fotorek;
        //     $validator['fotorek'] = $filename_fotorek;
        //     // Storage::disk('public')->put($filename_tugas,$filename_tugas);
        //     $file_fotorek->storeAs('fotorek', $filename_fotorek);
        //     $record['fotorek'] = $filename_fotorek;
        // }
        // untuk TTD
        // $signature = $request->signature;
        // $signatureFileName = uniqid() . '.png';
        // $signature = str_replace('data:image/png;base64,', '', $signature);
        // $signature = str_replace(' ', '+', $signature);
        // $ttd = base64_decode($signature);
        // $file = 'ttdSosialisasi/' . $signatureFileName;
        // // Storage::disk('public')->put($file, $ttd);
        // $ttd->storeAs('ttdSosialisasi', $signatureFileName);
        // $record['ttd'] = $file;

        $unit = Daftarhadir::updateOrCreate($record);
        return response()->json($unit);
    }










    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftarhadir  $daftarhadir
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daftarhadir  $daftarhadir
     * @return \Illuminate\Http\Response
     */
    public function edit(Daftarhadir $daftarhadir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDaftarhadirRequest  $request
     * @param  \App\Models\Daftarhadir  $daftarhadir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDaftarhadirRequest $request, Daftarhadir $daftarhadir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftarhadir  $daftarhadir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daftarhadir $daftarhadir)
    {
        //
    }
}










// //naked raw query php
// $koneksiSinadita = mysqli_connect("localhost", "bansmpro_root", "kmzwa88saa") or die("could not connect to mysql");
// mysqli_select_db($koneksiSinadita, "bansmpro_visitasi") or die("no database");
// $koneksiForm = mysqli_connect("localhost", "bansmpro_root", "kmzwa88saa") or die("could not connect to mysql");
// mysqli_select_db($koneksiForm, "bansmpro_jatim") or die("no database");
// $sqlQuery1 = mysqli_query($koneksiForm, "select *
// from daftarhadirs
// where kat_dh = '$kat'");
// while ($viewQuery1 = mysqli_fetch_array($sqlQuery1)) {
//     $niaParam = $viewQuery1['nia'];
//     $viewQuery2 = mysqli_fetch_array(mysqli_query($koneksiSinadita, "select tb_asesor.nama_tanpa_gelar, tb_asesor.gelar_depan, tb_asesor.gelar_belakang from tb_asesor where nia = '$niaParam'"));
//     $data[] = array(
//         'nia' => $niaParam,
//         'nama_asesor' => $viewQuery2['nama_tanpa_gelar'],
//         'nip' => $viewQuery1['nip'],
//         'hp' => $viewQuery1['hp'],
//         'unsur' => $viewQuery1['unsur'],
//         'jabatan' => $viewQuery1['jabatan'],
//         'unit' => $viewQuery1['unit'],
//         'alamat_kantor' => $viewQuery1['alamat_kantor'],
//         'kabkota' => $viewQuery1['kabkota'],
//         'tempat_lahir' => $viewQuery1['tempat_lahir'],
//         'tgl_lahir' => $viewQuery1['tgl_lahir'],
//         'ttd' => $viewQuery1['ttd'],
//     );
// }
// //**END** of naked raw query php
