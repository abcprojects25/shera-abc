<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ImageController extends Controller
{
    public function generateImages(Request $request)
    {
        $request->validate([
            'word' => 'required|string',
            'count' => 'nullable|integer|min:1|max:4'
        ]);

        $word = $request->word;
        $count = $request->count ?? 4;

        try {
            $result = OpenAI::images()->generate([
                'prompt' => "Generate a visually appealing illustration for the word: {$word}",
                'size' => '512x512',
                'n' => $count
            ]);

            $urls = collect($result['data'])->pluck('url');

            return response()->json(['urls' => $urls]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
