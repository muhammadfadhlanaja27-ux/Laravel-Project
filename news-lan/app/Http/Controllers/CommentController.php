<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'name' => Auth::check() ? 'nullable' : 'required|string|max:255',
            'email' => Auth::check() ? 'nullable' : 'required|email|max:255',
        ]);

        $commentData = [
            'post_id' => $post->id,
            'comment' => $validated['comment'],
            'is_approved' => true, // Default belum disetujui (butuh moderasi)
        ];

        // Jika user login
        if (Auth::check()) {
            $commentData['user_id'] = Auth::id();
        } else {
            // Jika guest
            $commentData['name'] = $validated['name'];
            $commentData['email'] = $validated['email'];
        }

        Comment::create($commentData);

        return back()->with('success', 'Your comment has been submitted and is awaiting moderation.');
    }

    /**
     * Delete a comment (only owner or admin)
     */
    public function destroy(Comment $comment)
    {
        // Cek apakah user adalah pemilik komentar atau admin
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}