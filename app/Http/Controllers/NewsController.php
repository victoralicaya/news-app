<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = Http::get('https://content.guardianapis.com/search?q='.$request->search.'&api-key=2d4c5981-ca8f-4dff-b645-ff1bf4cc333c');

        $articles = collect($response->json()['response']['results'])->map(function ($article) {
            return [
                'section' => $article['sectionName'],
                'title' => $article['webTitle'],
                'url' => $article['webUrl'],
                'date' => Carbon::parse($article['webPublicationDate'])->format('d/m/Y'),
            ];
        });

        return response()->json($articles->groupBy('section'));
    }
}
