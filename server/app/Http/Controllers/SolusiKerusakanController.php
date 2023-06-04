<?php

namespace App\Http\Controllers;

use App\Models\SolusiKerusakan;
use App\Http\Requests\StoreSolusiKerusakanRequest;
use App\Http\Requests\UpdateSolusiKerusakanRequest;
use App\Http\Resources\SolusiKerusakanResource;
use App\Http\Resources\SolusiKerusakanCollection;
use Illuminate\Http\Request;

class SolusiKerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = SolusiKerusakan::orderBy(
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

        return new SolusiKerusakanCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSolusiKerusakanRequest $request)
    {
        $solusiKerusakan = SolusiKerusakan::create($request->input());
        return new SolusiKerusakanResource($solusiKerusakan);
    }

    /**
     * Display the specified resource.
     */
    public function show(SolusiKerusakan $solusiKerusakan)
    {
        return new SolusiKerusakanResource($solusiKerusakan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSolusiKerusakanRequest $request, SolusiKerusakan $solusiKerusakan)
    {
        $solusiKerusakan->fill($request->input());
        $solusiKerusakan->save();
        return new SolusiKerusakanResource($solusiKerusakan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolusiKerusakan $solusiKerusakan)
    {
        $solusiKerusakan->delete();
        return new SolusiKerusakanResource($solusiKerusakan);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        SolusiKerusakan::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
