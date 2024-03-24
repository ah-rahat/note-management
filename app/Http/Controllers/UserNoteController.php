<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;

class UserNoteController extends Controller
{
    public function create_note()
    {
        if (session()->has('loginId')) {
            $data = User::where('id', '=', session()->get('loginId'))->first();
        }

        return view('frontend.create_note', compact('data'));
    }

    public function note_post(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $saveNote = new Note();
        $saveNote->title = $request->title;
        $saveNote->content = $request->content;
        $saveNote->user_id = session()->get('loginId');
        $saveNote->created_at = now();
        $saveNote->updated_at = now();
        $checkSave = $saveNote->save();

        if ($checkSave) {
            return back()->with('success', 'Note Created successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function updateNote(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note = Note::findOrFail($id);
        $note->title = $validatedData['title'];
        $note->content = $validatedData['content'];
        $note->updated_at = now();
        $updateSave = $note->save();

        if ($updateSave) {
            session()->flash('success', 'Note updated successfully');
            return redirect()->route('user.dashboard');
        } else {
            session()->flash('fail', 'Something went wrong');
            return redirect()->route('user.dashboard');
        }
    }

    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return redirect()->back()->with('error', 'Note not found.');
        }

        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully.');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $userId = session()->get('loginId');

        $noteDatas = Note::where('user_id', $userId)
                         ->where(function ($query) use ($searchTerm) {
                             $query->where('title', 'LIKE', "%$searchTerm%")
                                   ->orWhere('content', 'LIKE', "%$searchTerm%");
                         })
                         ->get();

        if (session()->has('loginId')) {
            $data = User::where('id', '=', session()->get('loginId'))->first();
        }

        return view('dashboard', compact('noteDatas', 'data'));
    }
}
