<?php

namespace App\Http\Controllers;

use App\Creation;
use Illuminate\Http\Request;

class CreationController extends Controller
{
    public function index()
    {
        return Creation::all();
    }

    public function show(Creation $creation)
    {
        return $creation;
    }

    public function store(Request $request)
    {
        $creation = Creation::create($request->all());
        return response()->json($creation, 201);
    }

    public function update(Request $request, Creation $creation)
    {
        $creation->update($request->all());
        return response()->json($creation, 200);
    }

    public function delete(Creation $creation)
    {
        $creation->delete();

        return response()->json(null, 204);
    }
}
