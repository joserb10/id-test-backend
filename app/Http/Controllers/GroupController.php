<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /*Devolver al cliente todas los grupos que existen en la base de datos*/
    public function getGroups() {
        $groups = Group::all();

        return response([
            'groups' => $groups
        ]);
    }
}
