<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::latest()->get();
        return view('admin.tables.index', compact('tables'));
    }

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

    public function show(Table $table)
    {
        return response()->json($table);
    }

    public function edit(Table $table)
    {
        return response()->json($table);
    }

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

    public function destroy(Request $request, Table $table)
    {
        $table->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Table deleted'], 200);
        }

        return redirect()->route('admin.tables.index')->with('success', 'Table deleted.');
    }
}
