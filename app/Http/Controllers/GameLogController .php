<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaderboard;
use Illuminate\Support\Facades\DB;

class GameLogController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'word_number'   => 'required|integer',
                'score'         => 'required|integer',
                'time_taken'    => 'required|string',
                'bonus_used'    => 'required|boolean',
                'answer_status' => 'required|string',
            ]);

            DB::table('leaderboard')->insert([
    'user_id'       => 1,
    'word_number'   => $request->word_number,
    'score'         => $request->score,
    'time_taken'    => $request->time_taken,
    'bonus_used'    => $request->bonus_used ? 1 : 0,
    'answer_status' => $request->answer_status,
    'created_at'    => now(),
    'updated_at'    => now(),
]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
    \Log::error('Game log error: '.$e->getMessage());
    return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
    ], 500);
}

    }
}
