<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Http\Requests\StoreKerusakanRequest;
use App\Http\Requests\UpdateKerusakanRequest;
use App\Http\Resources\KerusakanResource;
use App\Http\Resources\KerusakanCollection;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = Kerusakan::orderBy(
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

        return new KerusakanCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKerusakanRequest $request)
    {
        $kerusakan = Kerusakan::create($request->input());
        return new KerusakanResource($kerusakan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kerusakan $kerusakan)
    {
        return new KerusakanResource($kerusakan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKerusakanRequest $request, Kerusakan $kerusakan)
    {
        $kerusakan->fill($request->input());
        $kerusakan->save();
        return new KerusakanResource($kerusakan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return new KerusakanResource($kerusakan);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        Kerusakan::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
