<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FromController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Form::query();

        if ($request->has('title')) {
            $query->where('title', 'like', "%{$request->input('title')}%");
        }

        return Inertia::render('Konva/FromIndex', [
            'forms' => $query->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Konva/FromEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        return Inertia::render('Konva/FromEdit', [
            'form' => $form,
            'toJson' => $form->toJson() ?? 'null',
        ]);
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
