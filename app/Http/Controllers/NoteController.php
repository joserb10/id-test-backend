<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class NoteController extends Controller
{
    /*Función para setear el group_id del usuario que se unio a un grupo y devolver todas las notas de ese grupo*/
    public function getNotesByGroup(Request $request) {

        $user = User::findOrFail($request->user_id);
        $user->group_id = $request->group_id;
        $user->save();

        $notes = DB::table('notes')->join('users', 'notes.user_id', '=', 'users.id')
                    ->select('notes.*', 'users.name as user_name')->where('notes.group_id',$request->group_id)->get();

        $group = Group::find($request->group_id);

        return response([
            'notes' => $notes,
            'group' => $group
        ]);
    }

    /*Función  para crear una nota y devolver todas las notas filtrada por grupo al cliente*/
    public function createNote(Request $request) {
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->group_id = $request->group_id;
        $note->user_id = $request->user_id;
        $note->image = $request->image;
        $note->save();

        $notes = DB::table('notes')->join('users', 'notes.user_id', '=', 'users.id')
                    ->select('notes.*', 'users.name as user_name')->where('notes.group_id',$request->group_id)->get();

        return response([
            'notes' => $notes
        ]);
    }

    /*Función para devolver al cliente las notas filtradas por grupo y rango de fecha de creación*/
    public function getNotesByDate(Request $request) {
        $to = Carbon::create($request->date_to);
        $to = $to->addDays(1);
        $notes = DB::table('notes')->join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as user_name')
                ->whereRaw("notes.group_id = $request->group_id and notes.created_at BETWEEN CAST('$request->date_from' AS DATE) AND CAST('$to' AS DATE)")
                ->get();

        return response([
            'notes' => $notes
        ]);
    }

    /*Función para devolver al cliente las notas filtradas por grupo y solo las que poseen imagen*/
    public function getNotesWithImage(Request $request) {
        $notes = DB::table('notes')->join('users', 'notes.user_id', '=', 'users.id')
                ->select('notes.*', 'users.name as user_name')
                ->whereRaw("notes.group_id = $request->group_id and notes.image is not null")
                ->get();

        return response([
            'notes' => $notes
        ]);
    }
}
