<?php

namespace App\Observers;

use App\Jobs\SendEmail;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NoteObserver
{
    /**
     * Handle the Note "created" event.
     *
     * @param  \App\Models\Note  $note
     * @return void
     */

    /*Función que se ejecuta al crear una nota, para enviar un correo de notificacion a
     todos los usuarios del grupo al que pertenece la nota con un job en cola*/
    public function created(Note $note)
    {
        $usersToSendEmail = User::where('group_id',$note->group_id)->get();

        if ($usersToSendEmail) {
            foreach ($usersToSendEmail as $user) {

                SendEmail::dispatch($note->title,$note->description,$user['email']);
            }
        }
    }

    /**
     * Handle the Note "updated" event.
     *
     * @param  \App\Models\Note  $note
     * @return void
     */
    public function updated(Note $note)
    {
        //
    }

    /**
     * Handle the Note "deleted" event.
     *
     * @param  \App\Models\Note  $note
     * @return void
     */
    public function deleted(Note $note)
    {
        //
    }

    /**
     * Handle the Note "restored" event.
     *
     * @param  \App\Models\Note  $note
     * @return void
     */
    public function restored(Note $note)
    {
        //
    }

    /**
     * Handle the Note "force deleted" event.
     *
     * @param  \App\Models\Note  $note
     * @return void
     */
    public function forceDeleted(Note $note)
    {
        //
    }
}
