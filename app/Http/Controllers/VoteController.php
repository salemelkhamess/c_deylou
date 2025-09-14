<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class VoteController extends Controller
{
    public function index()
    {
        $questions = Question::where('is_active', true)
            ->where(function($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->with('options')
            ->get();

        // Récupérer le hash du votant depuis le cookie
        $voterHash = request()->cookie('voter_hash');

        return view('fronts.votes.index', compact('questions', 'voterHash'));
    }

    public function vote(Request $request, Question $question)
    {
        // Vérifier si la question est active
        if (!$question->isActive()) {
            return back()->with('error', 'Cette question n\'est plus active.');
        }

        $request->validate([
            'option_id' => 'required|exists:options,id,question_id,' . $question->id,
        ]);

        // Générer ou récupérer le hash du votant
        $voterHash = $request->cookie('voter_hash');
        if (!$voterHash) {
            $voterHash = Vote::generateVoterHash();
        }

        // Vérifier si le votant a déjà voté pour cette question
        if (Vote::hasVoted($question->id, $voterHash)) {
            return back()->with('error', 'Vous avez déjà voté pour cette question.');
        }

        // Enregistrer le vote
        Vote::create([
            'question_id' => $question->id,
            'option_id' => $request->option_id,
            'voter_hash' => $voterHash,
            'ip_address' => $request->ip(),
        ]);

        // Rediriger avec un cookie pour mémoriser le votant
        return back()
            ->with('success', 'Votre vote a été enregistré avec succès.')
            ->cookie('voter_hash', $voterHash, 60 * 24 * 30); // Cookie valide 30 jours
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
