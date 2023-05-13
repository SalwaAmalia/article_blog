<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Session;
 
class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10);
        $currentPage = $articles->currentPage();
        $pages = $articles->lastPage(); 

        return view('home', compact('articles', 'currentPage', 'pages'));
    }

    public function show()
    {
        $articles = Article::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        $currentPage = $articles->currentPage();
        $pages = $articles->lastPage(); 
        return view('show', compact('articles', 'currentPage', 'pages'));
    }    

    public function create(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'required'
        ]);

        Article::insert([
            'title'=>$validatedData['title'],
            'author'=>$validatedData['author'],
            'description'=>$validatedData['description'],
            'publish_date' => $request->publish_date,
            'user_id'=> $user->id
        ]);

        return redirect()->action([ArticleController::class, 'show']);
    }

    public function detail($id)
    {
        $user = Auth::user();

        $article = Article::with('comments')->find($id);
        $latest_articles = Article::orderBy('publish_date', 'desc')->take(5)->get();

        return view('detail', compact('article', 'user', 'latest_articles'));
    }

    public function delete($id)
    {
        Article::where('id', $id)
                            ->delete();
        Session::flash('success', 'Artikel berhasil dihapus');
        return redirect()->action([ArticleController::class, 'show']);
    }

    public function edit($id)
    {
        $article = Article::where('id', $id)->first();
        return view('edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->author = $request->input('author');
        $article->publish_date = $request->input('publish_date');
        $article->save();

        Session::flash('success', 'Artikel berhasil diedit');

        return redirect()->action([ArticleController::class, 'show']);
    }

}