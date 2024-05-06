<?php

namespace App\Http\Controllers;

use App\Models\StatusTinggalModel;
use Illuminate\Http\Request;

class StatusTinggalController extends Controller
{


    
    public function index()
    {
        $metadata = (object) [
            'title' => 'Status Tempat Tinggal',
            'description' => 'Halaman Ubah Status Warga'
        ];
        $tinggal = StatusTinggalModel::all();
        return view('statusTinggal.index', compact('tinggal'))->with(['metadata' => $metadata, 'activeMenu' => 'tinggal']);
    }

    public function create()
    {
        $metadata = (object) [
            'title' => 'Status Tinggal',
            'description' => 'Halaman Ubah tinggal Warga'
        ];
        return view('statusTinggal.create', ['activeMenu' => 'tinggal', 'metadata' => $metadata]);
    }



    public function pengajuan()
    {
        $data = StatusTinggalModel::all();

        return view('component.statusTinggal', ['data' => $data]);
    }

    public function find($value)
    {
        if ($value == 'kosong') {
            $data = StatusTinggalModel::all();

            return view('component.statusTinggal', ['data' => $data]);

        } else {

            $data = StatusTinggalModel::whereAny(['nama_pengaju', 'NIK'], 'like', '%' . $value . '%')->get();

        }

        return view('component.statusTinggal', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required',
            'NIK' => 'required',
            'alamat_asal' => 'required',
            'alamat_pindah' => 'required',
            'status' => 'required',
            'foto_bukti' => 'required',
        ]);

        StatusTinggalModel::create($request->all());
        return redirect()->route('');

    }

    public function edit(string $id)
    {
        $laporan = StatusTinggalModel::find($id);
        return view('', compact(''));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pengaju' => 'required',
            'NIK' => 'required',
            'alamat_asal' => 'required',
            'alamat_pindah' => 'required',
            'status' => 'required',
            'foto_bukti' => 'required',
        ]);

        StatusTinggalModel::find($id)->update($request->all());
        return redirect('');
    }
    public function destroy(string $id)
    {
        $laporan = StatusTinggalModel::findOrFail($id)->delete();
    }
}
