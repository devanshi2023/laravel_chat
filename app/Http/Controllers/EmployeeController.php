<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Models\Employee;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class EmployeeController extends Controller
{
    //Add user page
    public function register()
    {
        return view('user.register');
    }
    //Storing new user data
    public function add(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'image'    => 'required|image',
        ], [
            'name.required'    => 'Name is required.',
            'email.required'   => 'Email is required.',
            'password.required' => 'Password is required.',
            'password.regex' => 'Password must contain at least one lowercase letter,one uppercase letter, one digit and a special character.',
        ]);
        $user = new User();
        $imagename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('profile'), $imagename);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imagename;

        $user->password = Hash::make($request->password);
        if ($user->save()) {
            $data = [
                'title' => 'Your credentials',
                'email' => $request->email,
                'password' => $request->password,
            ];
            // dispatch(new SendMail($data));
            return redirect()->route('user.login')->with('success', "Registration successful");
        }
        return redirect()
            ->back()
            ->withInput($request->input())
            ->with('error', 'Something went wrong!!!');
    }
    //Login user page
    public function login()
    {
        return view('user.login');
    }
    //Verify User
    public function verify(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            return redirect()->route('emp.index');
        }
        return redirect()
            ->back()
            ->withInput($request->input())
            ->with('error', 'Incorrect credentials');
    }
    //Dashboard page
    public function index(Request $request)
    {
        $search = $request['search'] ? $request['search'] : "";
        $loggedInUserId = auth()->id();

        // // Get the count of unread messages for the logged-in user
        // $unreadMessageCount = Message::where('read_at', null)
        //     ->where('receiver_id', $loggedInUserId)
        //     ->distinct('sender_id')
        //     ->count();
        $query = User::where('id', '!=', $loggedInUserId);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
        // Session::put('unreadMessageCount', $unreadMessageCount);

        $employees = $query->get();

        return view('employees.dashboard', compact('employees', 'search'));
    }
    public function getUnreadMessageCount(Request $request)
    {
        $loggedInUserId = auth()->id();
        $unreadMessageCount = Message::where('read_at', null)
            ->where('receiver_id', $loggedInUserId)
            ->distinct('sender_id')
            ->count();


        return response()->json(['unreadMessageCount' => $unreadMessageCount]);
    }

    //chats message
    // Update the showChat method in EmployeeController
    public function showChat($userId)
    {
        $user = User::find($userId);

        // $unreadMessageCount = Message::where('read_at', null)
        //     ->where('receiver_id', auth()->id())
        //     ->distinct('sender_id')
        //     ->count();

        $messages = Message::where('sender_id', auth()->id())
            ->where('receiver_id', $userId)
            ->orWhere('sender_id', $userId)
            ->where('receiver_id', auth()->id())
            ->orderBy('created_at')
            ->get();

        // Mark messages as read
        Message::where('sender_id', $userId)
            ->where('receiver_id', auth()->id())
            ->where('read_at', null)
            ->update(['read_at' => now()]);

        if (empty($user)) {
            return redirect()->route('emp.index')->with('error', "This record doesn't exist!!");
        } else {
            return view('employees.chat', compact('messages', 'user'));
        }
    }


    //send message
    public function sendMessage(Request $request)
    {
        $chat = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->input('receiver_id'),
            'content' => $request->input('message'),
        ]);

        if ($chat) {
            return response()->json(['status' => true, 'data' => $chat]);
        } else {
            return response()->json(['status' => false, 'message' => "Message not sent"]);
        }
    }

    //get conversation
    public function getConversations(Request $request)
    {
        Message::where('sender_id', $request->receiver_id)
            ->where('receiver_id', auth()->id())
            ->where('read_at', null)
            ->update(['read_at' => now()]);

        $lastmessage = Message::where('sender_id', auth()->id())->where('receiver_id', $request->receiver_id)->orWhere('sender_id', $request->receiver_id)->where('receiver_id', auth()->id())->orderBy('id', 'desc')
            ->first();

        $lastmessage_array = $lastmessage->toArray();
        if ($lastmessage) {
            return response()->json(['status' => true, 'data' => $lastmessage_array]);
        } else {
            return response()->json(['status' => false, 'message' => "message not get "]);
        }
    }
    //Logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
