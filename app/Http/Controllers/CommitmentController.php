<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Commitment;
use Illuminate\Http\Request;

class CommitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Commitment/Index', [
            'commitments' => Commitment::where('user_id', auth()->id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'details' => 'required',
            'amount' => 'required',
        ]);

        $attribute['user_id'] = auth()->id();

        $commitment = Commitment::create($attribute);

        return response()
            ->json(['message' => 'Commitment created!', 'commitment' => $commitment], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Commitment $commitment)
    {
        try {
            $commitment->delete();
            return response()
                ->json(['message' => 'Commitment deleted!'], 200);
        } catch (e) {
            return response()
                ->json(['message' => 'Something went wrong' . e], 500);
        }
    }
}
