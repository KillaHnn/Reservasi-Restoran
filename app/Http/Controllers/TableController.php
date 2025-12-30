<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::latest()->get();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.tables.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'table_number' => 'required|string|unique:tables,table_number',
            'capacity' => 'required|integer|min:1',
            'area' => 'required|in:indoor,outdoor,vip',
            'status' => 'required|in:active,inactive'
        ]);

        $table = Table::create($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Table created', 'data' => $table], 201);
        }

        return redirect()->route('admin.tables.index')->with('success', 'Table created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        return response()->json($table);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        return response()->json($table);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $data = $request->validate([
            'table_number' => 'required|string|unique:tables,table_number,' . $table->id,
            'capacity' => 'required|integer|min:1',
            'area' => 'required|in:indoor,outdoor,vip',
            'status' => 'required|in:active,inactive'
        ]);

        $table->update($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Table updated', 'data' => $table], 200);
        }

        return redirect()->route('admin.tables.index')->with('success', 'Table updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Table $table)
    {
        $table->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Table deleted'], 200);
        }

        return redirect()->route('admin.tables.index')->with('success', 'Table deleted.');
    }
}
