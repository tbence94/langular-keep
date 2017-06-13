<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        return Note::orderByDesc('created_at')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required',
            'description' => ''
        ]);

        return Note::create($request->all());
    }

    public function show($id)
    {
        return Note::findOrFail($id);
    }

    public function update($id, Request $request)
    {
        $note = Note::findOrFail($id);

        return $note->update($request->all()) ? $note : response()->status(500);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        return $note->delete() ? $this->index() : response()->status(500);
    }
}
