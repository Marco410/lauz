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

    public function get(Request $request){ 
        $notes = Note::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();

        return response()->json($notes);   
    }

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
