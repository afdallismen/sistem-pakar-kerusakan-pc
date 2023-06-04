<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Rule;
use App\Models\GejalaKonsultasi;
use App\Http\Requests\StoreKonsultasiRequest;
use App\Http\Requests\UpdateKonsultasiRequest;
use App\Http\Resources\KonsultasiResource;
use App\Http\Resources\KonsultasiCollection;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function calculateCf(Konsultasi $konsultasi)
    {
        $gejalaIds = GejalaKonsultasi::where('konsultasi_id', $konsultasi->id)->get()->pluck('gejala_id');
        $kerusakans = Rule::select('kerusakan_id')
            ->groupBy('kerusakan_id')
            ->get()
            ->map(function (Rule $item) {
                $item['rules'] = Rule::select(['gejala_id', 'mb', 'md'])
                    ->where('kerusakan_id', $item['kerusakan_id'])
                    ->get();
                return $item;
            })
            ->filter(function (Rule $item) use ($gejalaIds) {
                return count(
                    $item['rules']->pluck('gejala_id')->intersect($gejalaIds)
                ) === count(
                    $item['rules']->pluck('gejala_id')
                );
            })
            ->map(function (Rule $item) {
                $results = $item['rules']->reduce(function ($carry, Rule $rule, int $key) use ($item) {
                    if ($key == 0) {
                        return [$rule['mb'], $rule['md'], $carry[2]];
                    } else {
                        $newMb = $carry[0] + $rule['mb'] * (1 - $carry[0]);
                        $newMd = $carry[1] + $rule['md'] * (1 - $carry[1]);
                        return [$newMb, $newMd, $newMb - $newMd];
                    }
                }, [0, 0, 0]);
                $item['cf'] = round($results[2], 2);
                return $item;
            })
            ->sortByDesc('cf')
            ->values();

        if (array_key_exists(0, $kerusakans->toArray())) {
            $konsultasi->fill([
                'kerusakan_id' => $kerusakans[0]->kerusakan_id,
                'cf' => $kerusakans[0]->cf,
            ]); 
        } else {
            $konsultasi->fill([
                'kerusakan_id' => null,
                'cf' => 0,
            ]);
        }

        $konsultasi->save();

        return new KonsultasiResource($konsultasi);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = Konsultasi::orderBy(
            $request->query('sort', 'id'),
            strtolower($request->query('order', 'asc'))
        );

        if ($request->has('ids')) {
            $qb = $qb->whereIn('id', explode(',', $request->query('ids')))->get();
        } elseif ($request->has('pelanggan_id')) {
            $qb = $qb->whereIn('pelanggan_id', explode(',', $request->query('pelanggan_id')))->get();
        } else {
            $qb = $qb->paginate(
                page: (int) $request->query('page', 1),
                perPage: (int) $request->query('perPage', 10)
            );
        }

        return new KonsultasiCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKonsultasiRequest $request)
    {
        $konsultasi = Konsultasi::create([
            'deskripsi' => $request->input('deskripsi'),
            'pelanggan_id' => $request->input('pelanggan_id')
        ]);

        if (count($request->input('gejala_ids')) > 0) {
            GejalaKonsultasi::insert(
                array_map(
                    function ($el) use ($konsultasi) {
                        return [
                            'konsultasi_id' => $konsultasi->id,
                            'gejala_id' => $el
                        ];
                    },
                    $request->input('gejala_ids')
                )
            );
            $gejalaIds = $request->input('gejala_ids');
            $kerusakans = Rule::select('kerusakan_id')
                ->groupBy('kerusakan_id')
                ->get()
                ->map(function (Rule $item) {
                    $item['rules'] = Rule::select(['gejala_id', 'mb', 'md'])
                        ->where('kerusakan_id', $item['kerusakan_id'])
                        ->get();
                    return $item;
                })
                ->filter(function (Rule $item) use ($gejalaIds) {
                    return count(
                        $item['rules']->pluck('gejala_id')->intersect($gejalaIds)
                    ) === count(
                        $item['rules']->pluck('gejala_id')
                    );
                })
                ->map(function (Rule $item) {
                    $results = $item['rules']->reduce(function ($carry, Rule $rule, int $key) use ($item) {
                        if ($key == 0) {
                            return [$rule['mb'], $rule['md'], $carry[2]];
                        } else {
                            $newMb = $carry[0] + $rule['mb'] * (1 - $carry[0]);
                            $newMd = $carry[1] + $rule['md'] * (1 - $carry[1]);
                            return [$newMb, $newMd, $newMb - $newMd];
                        }
                    }, [0, 0, 0]);
                    $item['cf'] = round($results[2], 2);
                    return $item;
                })
                ->sortByDesc('cf')
                ->values();

            if (array_key_exists(0, $kerusakans->toArray())) {
                $konsultasi->fill([
                    'kerusakan_id' => $kerusakans[0]->kerusakan_id,
                    'cf' => $kerusakans[0]->cf,
                ]); 
            } else {
                $konsultasi->fill([
                    'kerusakan_id' => null,
                    'cf' => 0,
                ]);
            }

            $konsultasi->save();
        };
        
        return new KonsultasiResource($konsultasi);
    }

    /**
     * Display the specified resource.
     */
    public function show(Konsultasi $konsultasi)
    {
        return new KonsultasiResource($konsultasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKonsultasiRequest $request, Konsultasi $konsultasi)
    {
        $konsultasi->fill($request->input());
        $konsultasi->save();
        return new KonsultasiResource($konsultasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konsultasi $konsultasi)
    {
        $konsultasi->delete();
        return new KonsultasiResource($konsultasi);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        Konsultasi::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
