<?php

namespace App\Http\Controllers;

use App\Output;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outputs = Output::all();

        return view('output.list', compact('outputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('output.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pin' => 'required|integer|between:0,40',
        ]);

        Output::create($request->only(['name', 'pin']));

        return redirect()->route("output.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function edit(Output $output)
    {
        return view('output.edit', compact('output'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Output $output)
    {
        $request->validate([
            'name' => 'required',
            'pin' => 'required|integer|between:0,40',
        ]);

        $output->update($request->only(['name', 'pin']));

        return redirect()->route('output.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Output $output
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Output $output)
    {
        $output->delete();

        return redirect()->route('output.index');
    }

    /**
     * Enable the output
     * @param Output $output
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Output $output)
    {
        $output->enable();

        return redirect()->back();
    }

    /**
     * Disable the output
     * @param Output $output
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Output $output)
    {
        $output->disable();

        return redirect()->back();
    }
}
