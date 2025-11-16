<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Badge;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{
    /**
     * Store a newly created quiz attempt in storage.
     * This handles server-side grading.
     * Spec 3.A & 4.A
     */
    public function store(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $user = Auth::user();
        $answers = $request->input('answers', []);

        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            if (!isset($answers[$question->id])) {
                continue; // Skip if question wasn't answered
            }

            $userAnswer = $answers[$question->id];
            
            switch ($question->type) {
                case 'multiple_choice':
                case 'fill_in_blank':
                    // Case-insensitive comparison for fill-in-the-blank
                    if (strcasecmp(trim($userAnswer), trim($question->correct_answer)) == 0) {
                        $score++;
                    }
                    break;
                
                case 'matching':
                    // Assumes $userAnswer is an array from the form, e.g., answers[q_id][0], answers[q_id][1]
                    // And that it's in the same order as $question->options['prompts']
                    $correctMatches = $question->options['answers'] ?? [];
                    if (is_array($userAnswer) && count($userAnswer) == count($correctMatches)) {
                        $matches = 0;
                        for ($i = 0; $i < count($correctMatches); $i++) {
                            if (isset($userAnswer[$i]) && strcasecmp(trim($userAnswer[$i]), trim($correctMatches[$i])) == 0) {
                                $matches++;
                            }
                        }
                        // Grant partial credit for matching, or all-or-nothing
                        // Here, we'll do all-or-nothing for the whole question
                        if ($matches == count($correctMatches)) {
                            $score++;
                        }
                    }
                    break;
            }
        }

        // Calculate percentage
        $percentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        // Create the quiz attempt
        QuizAttempt::create([
            "quiz_id" => $quiz->id,
            "user_id" => $user->id,
            "score" => $percentage
        ]);

        // --- Gamification Logic (Spec 4.A) ---
        $pointsEarned = 0;
        
        // 1. Base points for attempting
        $pointsEarned += 10; 

        // 2. Bonus points for high score
        if ($percentage == 100) {
            $pointsEarned += 50; // Perfect score bonus!
        } elseif ($percentage >= 80) {
            $pointsEarned += 20;
        }
        
        $user->increment('points', $pointsEarned);

        // 3. Award Badges
        $this->awardBadge($user, 'First Quiz Completed!');
        if ($percentage == 100) {
            $this->awardBadge($user, 'Perfectionist');
        }
        // --- End Gamification ---

        return redirect("/performance")->with('success', 'Quiz submitted! You earned ' . $pointsEarned . ' points.');
    }

    /**
     * Helper function to award a badge by name.
     */
    private function awardBadge(User $user, string $badgeName)
    {
        // Find the badge
        $badge = Badge::where('name', $badgeName)->first();
        if (!$badge) {
            return; // Badge doesn't exist
        }

        // Check if user already has it and attach if not
        if (!$user->badges->contains($badge->id)) {
            $user->badges()->attach($badge->id, ['earned_at' => now()]);
        }
    }
}