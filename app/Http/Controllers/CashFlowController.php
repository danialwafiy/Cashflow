<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cashflow;
use App\Models\Commitment;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Cashflow/Index', [
            'cashflows' => Cashflow::where('user_id', auth()->id())
                ->with('spendings')
                ->orderBy('month', 'DESC')
                ->orderBy('year', 'DESC')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cashflow/New', [
            'commitments' => Commitment::where('user_id', auth()->id())->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'month' => 'required',
            'year' => 'required',
            'initial_salary' => 'required',
            'total_spending' => 'required',
            'savings' => 'required',
            'positive' => 'required',
        ]);

        $attribute['user_id'] = auth()->id();

        $cashflow = Cashflow::create($attribute);

        if ($spendings = json_decode($request->spendings, true))
            $cashflow->addSpending($spendings);

        return response()
            ->json(['message' => 'Cashflow created!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cashflow $cashflow)
    {
        return Inertia::render('Cashflow/Show', [
            'cashflow' => $cashflow
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
