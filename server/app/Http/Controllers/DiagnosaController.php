<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Http\Requests\StoreDiagnosaRequest;
use App\Http\Requests\UpdateDiagnosaRequest;
use App\Http\Resources\DiagnosaResource;
use App\Http\Resources\DiagnosaCollection;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = Diagnosa::orderBy(
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

        return new DiagnosaCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiagnosaRequest $request)
    {
        $diagnosa = Diagnosa::create($request->input());
        return new DiagnosaResource($diagnosa);
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosa $diagnosa)
    {
        return new DiagnosaResource($diagnosa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiagnosaRequest $request, Diagnosa $diagnosa)
    {
        $diagnosa->fill($request->input());
        $diagnosa->save();
        return new DiagnosaResource($diagnosa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosa $diagnosa)
    {
        $diagnosa->delete();
        return new DiagnosaResource($diagnosa);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        Diagnosa::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
