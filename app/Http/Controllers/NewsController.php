<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('status', 'published');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->latest('published_at')->paginate(9);

        return view('pages.news.index', compact('news'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $recentNews = News::where('status', 'published')->where('id', '!=', $article->id)->latest('published_at')->take(4)->get();

        return view('pages.news.show', compact('article', 'recentNews'));
    }
}
