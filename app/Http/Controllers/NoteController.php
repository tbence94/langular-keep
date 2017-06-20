<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
//        usleep(800000);
        return Note::orderByDesc('created_at')->get();
    }

    public function archived()
    {
//        usleep(1000000);
        return Note::onlyTrashed()->orderByDesc('deleted_at')->get();
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

        return $note->forceDelete() ? "" : response()->status(500);
    }

    public function archive($id)
    {
        $note = Note::findOrFail($id);

        return $note->delete() ? "" : response()->status(500);
    }

    public function unarchive($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);

        return $note->restore() ? "" : response()->status(500);
    }

    public function clearArchive()
    {
        $archivedNotes = Note::onlyTrashed()->get();

        return $archivedNotes->each->forceDelete() ? "" : response()->status(500);
    }
}
