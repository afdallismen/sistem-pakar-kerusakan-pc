<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Http\Resources\PelangganResource;
use App\Http\Resources\PelangganCollection;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = Pelanggan::orderBy(
            $request->query('sort', 'id'),
            strtolower($request->query('order', 'asc'))
        );

        if ($request->has('ids')) {
            $qb = $qb->whereIn('id', explode(',', $request->query('ids')))->get();
        } else {
            $qb = $qb->paginate(
                page: (int) $request->query('page', 1),
                perPage: (int) $request->query('perPage', 10)
            );
        }

        return new PelangganCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        $pelanggan = Pelanggan::firstOrCreate(
            ['nohp' => $request->input('nohp')],
            ['nama' => $request->input('nama'), 'alamat' => $request->input('alamat')]
        );
        return new PelangganResource($pelanggan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return new PelangganResource($pelanggan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->fill($request->input());
        $pelanggan->save();
        return new PelangganResource($pelanggan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return new PelangganResource($pelanggan);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        Pelanggan::destroy($ids);
        return ['data' => explode(',', $ids)];
    }

    public function report()
    {
        $pelanggans = Pelanggan::orderBy('nama', 'asc')->get();
        $pdf = SnappyPdf::loadView('report_pelanggan', ['pelanggans' => $pelanggans]);
        return $pdf->download('laporan_pelanggan_'.time().'.pdf');
        // return view('report_pelanggan', ['pelanggans' => $pelanggans]);
    }
}
