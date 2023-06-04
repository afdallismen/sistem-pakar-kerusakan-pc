<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Http\Requests\StoreRuleRequest;
use App\Http\Requests\UpdateRuleRequest;
use App\Http\Resources\RuleResource;
use App\Http\Resources\RuleCollection;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $qb = Rule::orderBy(
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

        return new RuleCollection($qb);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRuleRequest $request)
    {
        $rule = Rule::create($request->input());
        return new RuleResource($rule);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule)
    {
        return new RuleResource($rule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuleRequest $request, Rule $rule)
    {
        $rule->fill($request->input());
        $rule->save();
        return new RuleResource($rule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();
        return new RuleResource($rule);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->query('ids');
        Rule::destroy($ids);
        return ['data' => explode(',', $ids)];
    }
}
