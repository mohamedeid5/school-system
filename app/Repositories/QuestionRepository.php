<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;
use App\Models\Quiz;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        $questions = Question::all();

        return view('pages.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::all();

        return view('pages.questions.create', compact('quizzes'));
    }

    public function store($request)
    {
        Question::create([
            'title' => $request->title,
            'answers' => $request->answers,
            'right_answer' => $request->right_answer,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
        ]);

        return redirect()->route('questions.index');
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quiz::all();

        return view('pages.questions.edit', compact('question','quizzes'));
    }

    public function update($request, $id)
    {
        $question = Question::findOrFail($id);

        $question->update([
            'title' => $request->title,
            'answers' => $request->answers,
            'right_answer' => $request->right_answer,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index');
    }
}
