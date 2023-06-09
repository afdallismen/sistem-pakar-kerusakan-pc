<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Rule;
use App\Models\GejalaKonsultasi;
use App\Models\Diagnosa;
use App\Http\Requests\StoreKonsultasiRequest;
use App\Http\Requests\UpdateKonsultasiRequest;
use App\Http\Resources\KonsultasiResource;
use App\Http\Resources\KonsultasiCollection;
use App\Http\Resources\DiagnosaCollection;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;

class KonsultasiController extends Controller
{
    public function diagnosa(Konsultasi $konsultasi)
    {
        $gejalaIds = GejalaKonsultasi::where('konsultasi_id', $konsultasi->id)->get()->pluck('gejala_id');
        $diagnosa = Rule::select('kerusakan_id')
            ->groupBy('kerusakan_id')
            ->get()
            ->map(function (Rule $kerusakan) {
                $kerusakan['rules'] = Rule::select(['gejala_id', 'mb', 'md'])
                    ->where('kerusakan_id', $kerusakan['kerusakan_id'])
                    ->get();
                return $kerusakan;
            })
            ->filter(function (Rule $kerusakan) use ($gejalaIds) {
                return count(
                    $kerusakan['rules']->pluck('gejala_id')->intersect($gejalaIds)
                ) > 0;
            })
            ->map(function (Rule $kerusakan) use ($gejalaIds, $konsultasi) {
                $results = $kerusakan['rules']
                    ->filter(function (Rule $rule) use ($gejalaIds) {
                        return $gejalaIds->contains($rule['gejala_id']);
                    })
                    ->values()
                    ->reduce(function ($carry, Rule $rule, int $key) {
                        if ($key === 0) {
                            return [$rule['mb'], $rule['md'], $rule['mb'] - $rule['md']];
                        } else {
                            $newMb = $carry[0] + $rule['mb'] * (1 - $carry[0]);
                            $newMd = $carry[1] + $rule['md'] * (1 - $carry[1]);
                            return [$newMb, $newMd, $newMb - $newMd];
                        }
                    }, [0, 0, 0]);

                return Diagnosa::updateOrCreate(
                    ['konsultasi_id' => $konsultasi->id, 'kerusakan_id' => $kerusakan->kerusakan_id],
                    ['cf' => round($results[2], 2)]
                );
            });

        return new DiagnosaCollection($diagnosa);
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
            $gejalaIds = GejalaKonsultasi::where('konsultasi_id', $konsultasi->id)->get()->pluck('gejala_id');
            $diagnosa = Rule::select('kerusakan_id')
            ->groupBy('kerusakan_id')
            ->get()
            ->map(function (Rule $kerusakan) {
                $kerusakan['rules'] = Rule::select(['gejala_id', 'mb', 'md'])
                    ->where('kerusakan_id', $kerusakan['kerusakan_id'])
                    ->get();
                return $kerusakan;
            })
            ->filter(function (Rule $kerusakan) use ($gejalaIds) {
                return count(
                    $kerusakan['rules']->pluck('gejala_id')->intersect($gejalaIds)
                ) > 0;
            })
            ->map(function (Rule $kerusakan) use ($gejalaIds, $konsultasi) {
                $results = $kerusakan['rules']
                    ->filter(function (Rule $rule) use ($gejalaIds) {
                        return $gejalaIds->contains($rule['gejala_id']);
                    })
                    ->values()
                    ->reduce(function ($carry, Rule $rule, int $key) {
                        if ($key === 0) {
                            return [$rule['mb'], $rule['md'], $rule['mb'] - $rule['md']];
                        } else {
                            $newMb = $carry[0] + $rule['mb'] * (1 - $carry[0]);
                            $newMd = $carry[1] + $rule['md'] * (1 - $carry[1]);
                            return [$newMb, $newMd, $newMb - $newMd];
                        }
                    }, [0, 0, 0]);

                return Diagnosa::updateOrCreate(
                    ['konsultasi_id' => $konsultasi->id, 'kerusakan_id' => $kerusakan->kerusakan_id],
                    ['cf' => round($results[2], 2)]
                );
            });

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

    public function report()
    {
        setlocale(LC_TIME, 'id_ID');
        $konsultasis = Konsultasi::with('diagnosas.kerusakan', 'pelanggan', 'gejala_konsultasis.gejala')
            ->get()
            ->sortBy('created_at')
            ->reduce(function ($carry, $konsultasi) {
                $month = date('M Y',strtotime($konsultasi->created_at));
                if (!array_key_exists($month, $carry)) {
                    $carry[$month] = [$konsultasi];
                } else {
                    array_push($carry[$month], $konsultasi);
                }
                return $carry;
            }, []);
        $pdf = SnappyPdf::loadView('report_konsultasi', ['konsultasis' => $konsultasis]);
        return $pdf->download('laporan_konsultasi_'.time().'.pdf');
        // return view('report_konsultasi', ['konsultasis' => $konsultasis]);
    }
}
