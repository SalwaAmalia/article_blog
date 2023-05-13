<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function edit($id)
	{
		$comment = Comment::findOrFail($id);

		return redirect()->route('comment.edit', ['id' => $id]);
	}

	public function update(Request $request, $id)
	{
		$comment = Comment::findOrFail($id);

		$comment->content = $request->input('content');
		$comment->save();

		return redirect()->route('detail', ['id' => $comment->article_id]);
	}

	public function delete($id)
	{
		$comment = Comment::findOrFail($id);
		$comment->delete();

		return redirect()->back();
	}


	/**
	 * Store a newly created resource in storage.
	 */
	public function create(Request $request)
	{
		$user = Auth::user();
        $validatedData = $request->validate([
            'content' => 'required|max:255'
        ]);

        Comment::insert([
            'article_id'=>$request->article_id,
            'user_id'=>$user->id,
            'content'=>$validatedData['content']
        ]);

		return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
	}
}
