<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Http\Requests\StoreGejalaRequest;
use App\Http\Requests\UpdateGejalaRequest;
use App\Http\Resources\GejalaResource;
use App\Http\Resources\GejalaCollection;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = Gejala::orderBy(
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

        return new GejalaCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGejalaRequest $request)
    {
        $gejala = Gejala::create($request->input());
        return new GejalaResource($gejala);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gejala $gejala)
    {
        return new GejalaResource($gejala);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGejalaRequest $request, Gejala $gejala)
    {
        $gejala->fill($request->input());
        $gejala->save();
        return new GejalaResource($gejala);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return new GejalaResource($gejala);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        Gejala::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
