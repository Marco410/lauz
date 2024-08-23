<?php

namespace App\Http\Controllers\Lauz;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Services\BigQueryService;

class NoteController extends Controller
{
    /**
     * Retrieves the notes for the authenticated user, ordered by creation date in descending order.
     *
     * @param Request $request The HTTP request object containing any additional data needed for the operation.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing an array of the user's notes, ordered by creation date in descending order.
     */
    public function get(Request $request){ 
        $notes = Note::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();

        return response()->json($notes);   
    }
    
    /**
     * Creates a new note for the authenticated user.
     *
     * @param Request $request The HTTP request object containing the note content to be added.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the newly created note and the total count of notes for the user.
     * @throws Exception If the note creation fails.
     */
    public function create(Request $request){ 
        $note = Note::create([
            'user_id' => Auth::user()->id,
            'note' => $request->note,
        ]);

        $notesCount = Note::where('user_id', Auth::user()->id)->count();

        if($note){
            $note['success'] = true;
            $note['count'] = $notesCount;
            return response()->json($note);     
        }else{
            $note['success'] = false;
            return response()->json($note);   
        }
    }

}
