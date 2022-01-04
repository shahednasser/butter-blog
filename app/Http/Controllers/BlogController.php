<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewPost;
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

    public function sendNotification (Request $request) {
        $butterClient = new ButterCMS(env('BUTTER_API_KEY'));
        //get slug from request
        $slug = $request->get('data.id');
        //get post
        $postResponse = $butterClient->fetchPost($slug);
        //get all users
        $users = User::all();
        if ($users->count()) {
            //send notification to slack
            Notification::sendNow($users, new NewPost($postResponse->getPost()->getTitle(), route('post', ['slug' => $postResponse->getPost()->getSlug()])));
        }
    }
}
