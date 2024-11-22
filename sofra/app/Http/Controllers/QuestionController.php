<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index_admin()
{
    $questions = Question::with('admin')->get();
    // dd($questions);
    return view('admin.questions.index', compact('questions'));
}
public function index()
{
    return view('contact-us');
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        'client_name' => 'required|string|max:255',
        'client_email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'question' => 'required|string',
    ]);

    Question::create($validatedData);

    return redirect()->back()->with('success', 'Your message has been sent successfully.');
}
public function resolve(Request $request, $id)
{
    $question = Question::findOrFail($id);
    $question->update([
        'resolved_by' => auth()->id(),
        // dd($question)
    ]);


    return redirect()->route('admin.questions.index')->with('success', 'Question marked as resolved.');
}

}
