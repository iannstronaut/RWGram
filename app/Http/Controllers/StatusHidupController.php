<?php

namespace App\Http\Controllers;

use App\Models\PendudukModel;
use App\Models\StatusHidupModel;
use Illuminate\Http\Request;

class StatusHidupController extends Controller
{
    public function index(Request $request)
    {
        $metadata = (object) [
            'title' => 'Status Hidup',
            'description' => 'Halaman Ubah Status Warga'
        ];

        $status = $request->query('status');

        $query = StatusHidupModel::query();
        if ($request->has('search')) {
            $hidup = $query->whereHas('penduduk', function ($query) use ($request) {
                $query->where('nama_penduduk', 'like', '%' . $request->search . '%');
            });
        }

        if ($status) {
            $query->where('status_pengajuan', $status);
        }

        $hidup = $query->paginate(5);

        return view('statusHidup.index', compact('hidup'))->with(['metadata' => $metadata, 'activeMenu' => 'permohonan']);
    }

    public function create()
    {
        $metadata = (object) [
            'title' => 'Status Hidup',
            'description' => 'Halaman Ubah Status Hidup Warga'
        ];
        return view('statusHidup.create', ['activeMenu' => 'permohonan', 'metadata' => $metadata]);
    }


    public function pengajuan()
    {
        $data = StatusHidupModel::with('Penduduk', 'PendudukM')->paginate(5);
        $hidup = StatusHidupModel::paginate(5);
        StatusHidupModel::where('terbaca', '=', '0')->update([
            'terbaca' => 1
        ]);
        return view('component.statusHidup', ['data' => $data]);
    }

    public function sort($sort = 'menunggu')
    {
        $data = StatusHidupModel::where('status_pengajuan', $sort)->with('penduduk')->paginate(5);


        return view('component.statusHidup', ['data' => $data]);
    }

    public function find($value)
    {
        if ($value == 'kosong') {
            $data = StatusHidupModel::paginate(5);

            return view('component.statusHidup', ['data' => $data]);
        } else {

            $id = PendudukModel::select('penduduk_id')->whereAny(['nama_penduduk', 'NIK'], 'like', '%' . $value . '%')->first();
            if ($id) {

                $data = StatusHidupModel::whereAny(['penduduk_id', 'id_penduduk_meninggal'], $id->penduduk_id)->paginate(5);
            } else {
                $data = StatusHidupModel::whereAny(['penduduk_id', 'id_penduduk_meninggal'], 0)->paginate(5);
            }
        }

        return view('component.statusHidup', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'NIK_pengaju' => 'required',
                'NIK_meninggal' => 'required',
                'foto_umkm' => 'required',
                'asset_id' => 'required',
            ]);

            $penduduk_pengaju = PendudukModel::where('NIK', $request->NIK_pengaju)->whereAll(['isDelete', 'status_kematian'], 0)->firstOrFail();
            $penduduk_meninggal = PendudukModel::where('NIK', $request->NIK_meninggal)->whereAll(['isDelete', 'status_kematian'], 0)->firstOrFail();


            StatusHidupModel::create([
                'penduduk_id' => $penduduk_pengaju->penduduk_id,
                'id_penduduk_meninggal' => $penduduk_meninggal->penduduk_id,
                'foto_bukti' => $request->foto_umkm,
                'asset_id' => $request->asset_id
            ]);

            return redirect()->route('hidup.penduduk.index')
                ->with('success', 'Data Berhasil Ditambahkan');



        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('hidup.penduduk.create')->with('error', 'Penduduk Tidak Aktif');
        }
    }

    public function edit(string $id)
    {
        $laporan = StatusHidupModel::find($id);
        return view('', compact(''));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_pengajuan' => 'required',
            'id_penduduk' => 'required'
        ]);

        try {
            $status = StatusHidupModel::findOrFail($id);
            $status->status_pengajuan = $request->status_pengajuan;
            $status->save();
        } catch (\Exception $e) {
            dd($e);
        }

        try {
            $penduduk = PendudukModel::findOrFail($request->id_penduduk);
            $penduduk->status_kematian = 1;
            $penduduk->save();
        } catch (\Exception $e) {
            dd($e);
        }


        return redirect('dashboard/pengajuan')->with('flash', ['success', 'Data berhasil dikonfirmasi']);
    }

    public function destroy(string $id)
    {
        try {
            $laporan = StatusHidupModel::findOrFail($id)->delete();
            return redirect('dashboard/pengajuan')->with('flash', ['success', 'data berhasil dihapus']);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function indexFind(Request $request)
    {
        $metadata = (object) [
            'title' => 'Status Meninggal',
            'description' => 'Halaman Ubah Status Warga'
        ];

        $search = $request->input('search');
        if (empty($search)) {
            $data = StatusHidupModel::paginate(5);
        } else {
            $data = StatusHidupModel::whereHas('penduduk', function ($query) use ($search) {
                $query->where('nama_penduduk', 'like', '%' . $search . '%')
                    ->orWhere('NIK', 'like', '%' . $search . '%');
            })->paginate(5);
        }

        return view('statusHidup.index', ['hidup' => $data])->with(['metadata' => $metadata, 'activeMenu' => 'permohonan']);
    }
}
