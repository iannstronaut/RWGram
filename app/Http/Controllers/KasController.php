<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluargaModel;
use App\Models\KasDetailModel;
use App\Models\KaslogModel;
use App\Models\KasModel;
use App\Models\PendudukModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use \PDF;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')->whereRaw('kas.')->pluck('sum(jumlah_kas)')->toArray();
        // $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')->pluck('MONTHNAME(tanggal_kas)')->toArray();

        $pengeluaran = intval(KaslogModel::selectRaw('sum(jumlah) as pengeluaran')->where('user_id', Auth::user()->user_id)->first()->pengeluaran);

        $auth = Auth::user()->user_id;
        switch ($auth) {
            case '1':
                # code...

                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')->whereRaw('kas.kartu_keluarga_id is null')->pluck('sum(jumlah_kas)')->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')->whereRaw('kas.kartu_keluarga_id is null')->pluck('MONTHNAME(tanggal_kas)')->toArray();
                $kas = KasDetailModel::with('user')
                    ->where('kartu_keluarga_id', null)
                    ->get();

                $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')

                    ->whereRaw('kas.kartu_keluarga_id is null')->first()->total);
                // dd($jumlah);

                break;
            case '3':
                # code...
                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 1')
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 1')
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();

                $kas = KasDetailModel::with('user')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->with('kartuKeluarga.penduduk', 'kartuKeluarga.kartuKeluarga')
                    ->whereRaw('kartu_keluarga.rt_id = 1')
                    ->get();

                $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 1')->first()->total);
                // dd($kas);
                break;
            case '5':
                # code...

                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 2')
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id =2')
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();

                $kas = KasDetailModel::with('user')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->with('kartuKeluarga.penduduk', 'kartuKeluarga.kartuKeluarga')
                    ->whereRaw('kartu_keluarga.rt_id = 2')
                    ->get();

                $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 2')->first()->total);

                break;
            case '6':
                # code...
                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 3')
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 3')
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();

                $kas = KasDetailModel::with('user')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->with('kartuKeluarga.penduduk', 'kartuKeluarga.kartuKeluarga')
                    ->whereRaw('kartu_keluarga.rt_id = 3')
                    ->get();
                $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 3')->first()->total);

                break;

            case '4':
                # code...

                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 4')
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 4')->first()->total);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 4')
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();

                $kas = KasDetailModel::with('user')
                    ->with('kartuKeluarga.penduduk', 'kartuKeluarga.kartuKeluarga')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw('kartu_keluarga.rt_id = 4')
                    ->get();

                break;

            default:
                # code...
                break;
        }
        // $kk = KartuKeluargaModel::all();

        $data = array_map('intval', $data);



        $active = 'kas';
        return view("dashboard.kas", compact('data', 'active', 'tgl', 'jumlah', 'kas', 'pengeluaran'));
    }

    public function kasByTanggal(Request $request)
    {
        $auth = Auth::user()->user_id;
        switch ($auth) {
            case '1':
                # code...

                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')->whereRaw("kas.kartu_keluarga_id is null AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")->pluck('sum(jumlah_kas)')->toArray();
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')->join('kas', 'kas.id_kas', 'detail_kas.id_kas')->whereRaw('kas.kartu_keluarga_id is null')->pluck('MONTHNAME(tanggal_kas)')->toArray();
                break;
            case '3':
                # code...
                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 1  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 1  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();
                break;
            case '5':
                # code...

                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 2  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 2  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();

                break;
            case '6':
                # code...
                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 3  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);
                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 3  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();
                break;

            case '4':
                # code...

                $data = KasModel::selectRaw('sum(jumlah_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 4  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('sum(jumlah_kas)')
                    ->toArray();
                // dd($data);

                $tgl = KasModel::selectRaw('MONTHNAME(tanggal_kas)')->groupByRaw('MONTHNAME(tanggal_kas)')
                    ->join('kas', 'kas.id_kas', 'detail_kas.id_kas')
                    ->join('kartu_keluarga', 'kartu_keluarga.kartu_keluarga_id', 'kas.kartu_keluarga_id')
                    ->whereRaw("kartu_keluarga.rt_id = 4  AND tanggal_kas BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")
                    ->pluck('MONTHNAME(tanggal_kas)')
                    ->toArray();

                break;

        }

        $data = ['data' => $data, 'tgl' => $tgl];

        return $data;
    }


    public function detailKas($kk)
    {


        try {

            $data = KasModel::where('id_kas', $kk)->with('kas')->get();

        } catch (\Exception $e) {
            dd($e);
        }

        // dd($data);
        return view('component.detail_kas', compact('data'));
    }

    public function kasMonth($bulan)
    {

    }

    public function pengeluaran()
    {
        //



        $kas = KaslogModel::where('user_id', Auth::user()->user_id)->get();


        $data = KasLogModel::selectRaw('sum(jumlah)')->groupByRaw('MONTHNAME(created_at)')->where('user_id', Auth::user()->user_id)->pluck('sum(jumlah)')->toArray();
        $tgl = KasLogModel::selectRaw('MONTHNAME(created_at)')->groupByRaw('MONTHNAME(created_at)')->pluck('MONTHNAME(created_at)')->toArray();
        // $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->first()->total);
        $data = array_map('intval', $data);
        $active = 'kas';
        return view("component.pengeluaran", compact('kas', 'data', 'tgl', 'active'));
    }

    public function pengeluaranByTanggal(Request $request)
    {
        // $kas = KaslogModel::where('user_id', Auth::user()->user_id)->get();
        $data = KasLogModel::selectRaw('sum(jumlah)')->groupByRaw('MONTHNAME(created_at)')->whereRaw("created_at BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")->where('user_id', Auth::user()->user_id)->pluck('sum(jumlah)')->toArray();
        $tgl = KasLogModel::selectRaw('MONTHNAME(created_at)')->groupByRaw('MONTHNAME(created_at)')->whereRaw("created_at BETWEEN '" . $request->tanggal_mulai . "' AND '" . $request->tanggal_akhir . "'")->pluck('MONTHNAME(created_at)')->toArray();
        $data = array_map('intval', $data);
        $data = array('data' => $data, 'tgl' => $tgl);

        return $data;
    }

    public function pengeluaranChart()
    {
        //



        $kas = KaslogModel::where('user_id', Auth::user()->user_id)->get();


        $data = KasLogModel::selectRaw('sum(jumlah)')->groupByRaw('MONTHNAME(created_at)')->where('user_id', Auth::user()->user_id)->pluck('sum(jumlah)')->toArray();
        $tgl = KasLogModel::selectRaw('MONTHNAME(created_at)')->groupByRaw('MONTHNAME(created_at)')->pluck('MONTHNAME(created_at)')->toArray();
        // $jumlah = intval(KasModel::selectRaw('sum(jumlah_kas) as total')->first()->total);
        $data = array_map('intval', $data);
        $merge = array('data' => $data, 'tgl' => $tgl);


        return response($merge);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("kas.create");
    }

    public function viewPDF()
    {
        // dd(KasDetailModel::with('kartuKeluarga.penduduk', 'kartuKeluarga.kartuKeluarga')->get()[0]); 
        $pdf = PDF::loadView('dashboard.pdf.kas', ['data' => KasDetailModel::with('kartuKeluarga.penduduk', 'kartuKeluarga.kartuKeluarga', 'user')->get()])
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }


    public function find($value)
    {
        if ($value == 'kosong') {


            return $this->index();
        } else {
            $user = Auth::user();
            try {

                $id = PendudukModel::with('kartuKeluarga', 'kartuKeluarga.rt')->whereAny(['nama_penduduk', 'NIK'], 'like', '%' . $value . '%')->firstOrFail();
            } catch (\Exception $e) {
                return '<p class="text-center font-bold text-xl text-neutral-10" id="umkm">Data Tidak Ditemukan <p>';
            }
            // dd($id);

            if ($id->kartuKeluarga->rt->rt_id == $user->role_id) {
                if ($id) {

                    $kas = KasDetailModel::where('kartu_keluarga_id', '=', $id->kartu_keluarga_id)->paginate(3);

                } else {
                    $kas = KasDetailModel::where('kartu_keluarga_id', '=', 0)->paginate(3);
                }
            }


        }

        return view("component.kas", compact('kas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);

        $kas = '';

        $auth = Auth::user()->user_id;
        switch ($auth) {
            case '1':
                # code...

                $kk = User::where('nama_user', '=', $request->nama_user)->first();
                // dd($request->nama_user);
                $kas = KasDetailModel::where('user_id', $kk->user_id)->first();

                break;

            default:
                try {

                    $kk = KartuKeluargaModel::where('NKK', '=', $request->NKK)->first();

                    $kas = KasDetailModel::where('kartu_keluarga_id', $kk->kartu_keluarga_id)->firstOrFail();

                    break;
                } catch (\Exception $e) {
                    return $e;
                }
        }




        foreach ($request->cek as $key => $value) {
            // dd($kas->$value);

            if ($request->$value[0] == null || $request->$value[1] == null || $request->$value[2] == null) {
                return redirect()->back()->with('flash', ['error', 'Data yang di inputkan kurang']);
            }
            if ($kas->$value) {
                // dd($kas->$key);
                return redirect()->back()->with('flash', ['error', 'Data kas sudah ada']);
            }




            try {
                KasModel::create([
                    'id_kas' => $kas->id_kas,
                    'bulan' => $request->$value[0],
                    'jumlah_kas' => $request->$value[2],
                    'tanggal_kas' => $request->$value[1]
                ]);

                $kas->$value = 1;
                $kas->save();

            } catch (\Exception $e) {

            }



        }


        return redirect('/dashboard/kas')->with('flash', ['success', 'Data berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kas = KasModel::with('kas', 'kartuKeluarga')->find($id);

        return view('kas.show', ['data' => $kas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kas = KasModel::find($id);

        return view('kas.edit', $data = ['data' => $kas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //
        $data = KasModel::find($id);

        $data->update([
            'kartu_keluarga_id' => $request->kartu_keluarga,
            'jumlah_kas' => $request->kas,
            'tanggal_kas' => $request->tanggal
        ]);

        return redirect('/kas')->with('success', 'Data berhasil diupdate');
    }

    public function storePengeluaran(Request $request)
    {

        // dd($request);
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'keterangan_kas_log' => 'required',
            'Jumlah' => 'required'
        ]);

        if ($validate->fails()) {

            return redirect()->back()->with('flash', ['error', 'data gagal ditambah']);
        }

        try {
            KaslogModel::create([
                'user_id' => $request->user_id,
                'keterangan_kas_log' => $request->keterangan_kas_log,
                'jumlah' => $request->Jumlah
            ]);
        } catch (\Exception $e) {
            return $e;
        }

        return redirect(url('/dashboard/kas'))->with('flash', ['success', 'Data berhasil ditambah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        try {
            KasModel::where('id_kas', $id)->delete();
            KasDetailModel::destroy($id);

            return redirect('/dashboard/kas')->with('flash', ['success', 'Data berhasil dihapus']);
        } catch (e) {
            return redirect('/dashboard/kas')->with('flash', ['error', 'Data gagal dihapus']);
        }
    }
    public function destroyPengeluaran($kk)
    {
        //

        try {

            KaslogModel::destroy($kk);

            return redirect('/dashboard/kas')->with('flash', ['success', 'Data berhasil dihapus']);
        } catch (e) {
            return redirect('/dashboard/kas')->with('flash', ['error', 'Data gagal dihapus']);
        }
    }
}
