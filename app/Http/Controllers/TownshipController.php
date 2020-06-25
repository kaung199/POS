<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Township;

class TownshipController extends Controller
{
    public function index()
    {
        $townships = Township::all();
        return view('townships.index', \compact('townships'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:townships,name',
        ]);
        $townships = Township::create($request->all());
        return redirect()->route('townships')
            ->with('success','Townships created successfully');
    }

    public function destroy($id)
    {
        Township::find($id)->delete();
        return redirect()->route('townships')
            ->with('success','Township deleted successfully');
    }
}
