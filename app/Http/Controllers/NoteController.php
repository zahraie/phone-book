<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getAll()
    {
        $notes = Note::all();
        return response()->json([
            'status' => 'ok',
            'data' => $notes
        ] , 200);
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'title'=> 'required | max:64 | min:3',
            'content' => 'required | max:256'
        ]);

        $note = new Note();
        $note->create($request->all());
//        Note::create($request->all());

        return response()->json([
            'status' => 'OK',
            'data' => $note
        ] , 200);
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'title'=> 'required | max:64 | min:3',
            'content' => 'required | max:256'
        ]);

        $note = Note::find($id);

        if(! $note){
            return response()->json([
                'status' => 'error',
                'message' => 'item not found'
            ], 404);
        }

        $note->update($request->json()->all());

        $note->save();
        return response()->json([
            'status' => 'OK',
            'result' => 'item updated successfully'
        ] , 200);
    }

    public function delete($id)
    {
        $note = Note::find($id);

        if(!$note){
            return response()->json([
                'status' => 'error',
                'message' => 'item not found'
            ], 404);
        }

        $note->delete();
//        return response()->json(['result' => 'item updated successfully'] , 200);
        return response()->json([
            'status' => 'ok',
            'message' => 'item updated successfully'
        ], 200);
    }

}
