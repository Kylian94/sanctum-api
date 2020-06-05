<?php

namespace App\Http\Controllers;

use App\Note;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        return response()->json([
            $notes,
            'status_code' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'content' => 'required',
            ]);

            $note = new Note;
            $note->user_id = Auth::user()->id;
            $note->content = $request->content;
            $note = $note->save();

            return response()->json([
                'status_code' => 200,
                'note_content' => $request->content,
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in creating note',
                'error' => $error,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $currentNote = Note::all()->where('id', $id)->first();

            if ($currentNote->user_id != Auth::user()->id) {
                return response()->json([
                    'status_code' => 403
                ]);
            }

            return response()->json([
                'content' => $currentNote->content,
                'status_code' => 200
            ]);
        } catch (Exception $error) {

            return response()->json([
                'message' => 'note not found',
                'status_code' => 404,
                'error' => $error
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {


        $request->validate([
            'content' => 'required',
        ]);

        $currentNote = Note::all()->where('id', $id)->first();



        if ($currentNote->user_id != Auth::user()->id) {
            return response()->json([
                'status_code' => 403
            ]);
        };

        $currentNote->update([
            'content' =>  $request->content
        ]);

        return response()->json([
            'content' => $request->content,
            'status_code' => 200
        ]);


        if (!$currentNote) {
            return response()->json([
                'message' => 'note not found',
                'status_code' => 404,
                'error' => $error
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }


    public function delete($id)
    {
        try {

            $currentNote = Note::all()->where('id', $id)->first();

            if ($currentNote->user_id != Auth::user()->id) {
                return response()->json([
                    'status_code' => 403
                ]);
            }

            $currentNote->delete();

            return response()->json([
                'content' => 'delete success',
                'status_code' => 200
            ]);
        } catch (Exception $error) {

            return response()->json([
                'message' => 'note not found',
                'status_code' => 404,
                'error' => $error
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        try {

            DB::table('users')->delete();
            DB::table('notes')->delete();
            DB::table('personal_access_tokens')->delete();

            return response()->json([
                'content' => 'all DB reset',
                'status_code' => 200
            ]);
        } catch (Exception $error) {

            return response()->json([
                'message' => 'Error',
                'status_code' => 404,
                'error' => $error
            ]);
        }
    }
}
