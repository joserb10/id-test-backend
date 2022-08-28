<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class NoteController extends Controller
{
    public function getNotesByGroup(Request $request) {
        $notes = DB::table('notes')->join('users', 'notes.user_id', '=', 'users.id')->select('notes.*', 'users.name as user_name')->where('notes.group_id',$request->group_id)->get();

        $group = Group::find($request->group_id);

        return response([
            'notes' => $notes,
            'group' => $group
        ]);
    }

    public function createNote(Request $request) {
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->group_id = $request->group_id;
        $note->user_id = $request->user_id;
        $note->image = $request->image;
        $note->save();

        $notes = DB::table('notes')->join('users', 'notes.user_id', '=', 'users.id')->select('notes.*', 'users.name as user_name')->where('notes.group_id',$request->group_id)->get();

        return response([
            'notes' => $notes
        ]);
    }
}
