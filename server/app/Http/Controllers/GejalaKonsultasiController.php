<?php

namespace App\Http\Controllers;

use App\Models\GejalaKonsultasi;
use App\Http\Requests\StoreGejalaKonsultasiRequest;
use App\Http\Requests\UpdateGejalaKonsultasiRequest;
use App\Http\Resources\GejalaKonsultasiResource;
use App\Http\Resources\GejalaKonsultasiCollection;
use Illuminate\Http\Request;

class GejalaKonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = GejalaKonsultasi::orderBy(
            $request->query('sort', 'id'),
            strtolower($request->query('order', 'asc'))
        );

        if ($request->has('ids')) {
            $qb = $qb->whereIn('id', explode(',', $request->query('ids')))->get();
        } elseif ($request->has('konsultasi_id')) {
            $qb = $qb->whereIn('konsultasi_id', explode(',', $request->query('konsultasi_id')))->get();
        }  else {
            $qb = $qb->paginate(
                page: (int) $request->query('page', 1),
                perPage: (int) $request->query('perPage', 10)
            );
        }

        return new GejalaKonsultasiCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGejalaKonsultasiRequest $request)
    {
        $gejalaKonsultasi = GejalaKonsultasi::create($request->input());
        return new GejalaKonsultasiResource($gejalaKonsultasi);
    }

    /**
     * Display the specified resource.
     */
    public function show(GejalaKonsultasi $gejalaKonsultasi)
    {
        return new GejalaKonsultasiResource($gejalaKonsultasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGejalaKonsultasiRequest $request, GejalaKonsultasi $gejalaKonsultasi)
    {
        $gejalaKonsultasi->fill($request->input());
        $gejalaKonsultasi->save();
        return new GejalaKonsultasiResource($gejalaKonsultasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GejalaKonsultasi $gejalaKonsultasi)
    {
        $gejalaKonsultasi->delete();
        return new GejalaKonsultasiResource($gejalaKonsultasi);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        GejalaKonsultasi::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
