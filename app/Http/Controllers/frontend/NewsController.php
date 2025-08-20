<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{

  public function index()
  {
   $news = News::paginate(1);
    return view('frontend.news.index', compact('news'));
  }

    public function detail($news)
    {
        $titlePossible = Str::of($news)->replace('-', ' ')->title();
        $news = News::where('title', 'LIKE', '%' . $titlePossible . '%')
                      ->first();

        if (!$news) {
            $newss = News::all();
            $foundNews = null;
            foreach ($newss as $b) {
                if (Str::slug($b->title) === $news) {
                    $foundBlog = $b;
                    break;
                }
            }
            $news = $foundNews;
        }


        if (!$news) {
            abort(404);
        }

        $title = $news->title;

        return view('frontend.news.detail', compact('news', 'title'));
    }
}
