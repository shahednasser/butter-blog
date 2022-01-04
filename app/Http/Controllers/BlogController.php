<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewComment;
use Illuminate\Http\Request;
use ButterCMS\ButterCMS;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function home() {
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));
        $postsResponse = $butterClient->fetchPosts();

        return view('home', ['posts' => $postsResponse->getPosts()]);
    }

    public function showPost (Request $request, $slug) {
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));
        try {
            $postResponse = $butterClient->fetchPost($slug);
        } catch (RequestException $error) {
            //in case the post is not found
            return redirect('/');
        }

        return view('post', ['post' => $postResponse->getPost(), 'errorMessage' => session('form-error'), 'successMessage' => session('form-success')]);
    }

    public function addComment (Request $request, $slug) {
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));
        //check if post exists
        try {
            $postResponse = $butterClient->fetchPost($slug);
        } catch (RequestException $error) {
            //in case the post is not found
            return back()->withInput()->with('form-error', 'Post does not exist');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'comment' => 'required|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->with('form-error', $validator->errors()->first());
        }

        //get all users
        $users = User::all();
        if ($users->count()) {
            //send notification to slack
            Notification::sendNow($users, new NewComment($request->get('name'), $request->get('comment'),
                $postResponse->getPost()->getTitle()));
        }

        return back()->with('form-success', 'Comment sent successfully');
    }
}
