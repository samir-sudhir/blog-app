<?php


namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use App\Models\Image;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    //function to create comment
    public function store(Request $request, $commentableType, $commentableId)
    {
        $commentable = $this->getCommentableModel($commentableType, $commentableId);
        $comment = new Comment(['body' => $request->body]);
        $commentable->comments()->save($comment);

        return response()->json($comment, 201);
    }
    //function to update comment

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->only('body'));

        return response()->json($comment, 200);
    }
    //function to destroy comment

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message'=>'The comment agianst this id has been deleted from databse'], 204);
    }

        //function to get Model

    public function index($commentableType, $commentableId)
    {
        $commentable = $this->getCommentableModel($commentableType, $commentableId);
        $comments = $commentable->comments;

        return response()->json($comments, 200);
    }

        // custom methods 

    private function getCommentableModel($type, $id)
    {
        $model = $this->resolveCommentableModel($type);
        return $model::findOrFail($id);
    }

    private function resolveCommentableModel($type)
    {
        $models = [
            'post' => Post::class,
            'video' => Video::class,
            'image' => Image::class,
        ];

        if (!array_key_exists($type, $models)) {
            abort(404, 'Model not found.');
        }

        return $models[$type];
    }

   
        //function to count comments
    public function countComments($commentableType, $commentableId)
{
    $commentable = $this->getCommentableModel($commentableType, $commentableId);
    $count = $commentable->comments()->count();

    return response()->json(['count' => $count], 200);
}

}
