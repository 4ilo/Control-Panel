<?php

namespace App\Http\Controllers\Api;

use App\Output;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutputApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Output[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $outputs = Output::all();

        return $outputs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pin' => 'required|integer|between:0,40',
        ]);

        Output::create($request->only(['name', 'pin']));

        return ['success' => 'true'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Output $output
     * @return Output
     */
    public function show(Output $output)
    {
        return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Output $output
     * @return array
     */
    public function update(Request $request, Output $output)
    {
        $request->validate([
            'name' => 'required',
            'pin' => 'required|integer|between:0,40',
        ]);

        $output->update($request->only(['name', 'pin']));

        return ['success' => 'true'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Output $output
     * @return array
     * @throws \Exception
     */
    public function destroy(Output $output)
    {
        $output->delete();

        return ['success' => 'true'];
    }
}
