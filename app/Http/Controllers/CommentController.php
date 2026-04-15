<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        return Comment::create($request->all());
    }

    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return $comment;
    }

    public function destroy($id)
    {
        Comment::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}