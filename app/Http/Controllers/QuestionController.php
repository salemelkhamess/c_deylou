<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:1000',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $question = Question::create([
            'question_text' => $request->question_text,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        foreach ($request->options as $optionText) {
            if (!empty(trim($optionText))) {
                $question->options()->create([
                    'option_text' => trim($optionText)
                ]);
            }
        }

        return redirect()->route('questions.index')
            ->with('success', 'Question créée avec succès.');
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string|max:1000',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Supprimer les anciennes options
        $question->options()->delete();

        // Créer les nouvelles options
        foreach ($request->options as $optionText) {
            if (!empty(trim($optionText))) {
                $question->options()->create([
                    'option_text' => trim($optionText)
                ]);
            }
        }

        return redirect()->route('questions.index')
            ->with('success', 'Question mise à jour avec succès.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')
            ->with('success', 'Question supprimée avec succès.');
    }

    public function toggleStatus(Question $question)
    {
        $question->update(['is_active' => !$question->is_active]);
        return back()->with('success', 'Statut de la question mis à jour.');
    }

    public function results(Question $question)
    {
        $question->load(['options' => function($query) {
            $query->withCount('votes');
        }]);

        $totalVotes = $question->votes()->count();
        $voterHash = request()->cookie('voter_hash');
        $hasVoted = $voterHash ? Vote::hasVoted($question->id, $voterHash) : false;

        return view('fronts.votes.results', compact('question', 'totalVotes', 'hasVoted'));
    }
}
