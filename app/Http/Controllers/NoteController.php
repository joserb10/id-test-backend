<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getNotesByGroup(Request $request) {
        $notes = Note::where('group_id', $request->group_id)->get();

        return response([
            'notes' => $notes
        ]);
    }
}
