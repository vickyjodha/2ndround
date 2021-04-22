<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user)
            return back()->with('error', 'email/password is incorrect');

        if (!Hash::check($request->password, $user->password))
            return back()->with('error', 'email/password is incorrect');

        Auth::login($user);
        $details = [
            'greeting' => 'Hi ' . $user->name,
            'body' => 'This is my first notification from test',
            'thanks' => 'Thank you for using test tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'order_id' => $user->id,
            'ip' => $request->ip(),
        ];
        $user->ip = $request->ip();
        $user->save();
        Notification::send($user, new MyFirstNotification($details));


        if (auth()->user()->is_admin == 1) {
            return redirect()->to('user');
        } else {
            return redirect()->to('home');
        }
        // return redirect()->to('home');
    }
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->ip = $request->ip();
        $user->save();
        Session::flash('success', 'Registered Successfully');
        return redirect()->to('home');
    }
    public function imageUploadPost(Request $request)
    {
        $user = new  User();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $images = $request->image->storeAs('images', $imageName);
        $user->image = $images;
        $user->save();
        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }
}
