<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }

    public function users()
    {
        try
        {
            $users = User::all();
            return view('admin.users.index')->with('users', $users);
        }
        catch (Exception $ex)
        {
            return redirect()->route('admin.index')->withErrors('Unknown error occurred!');
        }
    }

    public function show($id)
    {
        try
        {
            $user = User::find($id);

            // Check if user was found
            if (!$user)
                throw new \Exception('User does not exist!');

            //Only show user to admins
            if (!Auth::user()->isAdmin())
                throw new \Exception('Only administrative users can view users!');

            return view('admin.users.show')->with('user', $user);
        }
        catch (\Exception $ex)
        {
            return redirect()->route('admin.index')->withErrors($ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try
        {
            $user = User::find($id);

            //Check if user was found
            if(!$user)
                throw new \Exception('User does not exist!');

            //Only allow deletion if admin
            if(!Auth::user()->isAdmin())
                throw new \Exception('Only admins can delete users!');

            //Only allow deletion of non-admin users
            if ($user->isAdmin())
                throw new \Exception('Admin users cannot be deleted!');

            // Delete messages that are connected to user
            $user->sent()->delete();
            $user->received()->delete();

            // Delete user
            $user->delete();
            return redirect()->route('users.index')->withSuccess('Successfully deleted user!');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('users.index')->withErrors($ex->getMessage());
        }
    }

    public function download()
    {
        return Auth::user()->download();
    }

    public function add_key(Request $request)
    {
        $this->validate($request, [
            'key' => 'required'
        ]);

        $key = $request->key;
        $user = Auth::User();

        if($user->verify_key($key))
        {
            $user->key = $key;
            $user->save();

            return redirect()->route('key.index')->withSuccess('Game-key successfully added!');
        }
        else
        {
            return redirect()->route('key.index')->withErrors('Game-key is invalid!');
        }
    }

    public function verify_key(Request $request)
    {
        //TODO: Implement verify algo
        $this->validate($request, [
            'key' => 'required'
        ]);

        $key = $request->key;
        $user = Auth::User();

        if($user->verify_key($key))
        {
            return redirect()->route('key.index')->withSuccess('Game-key is valid!');
        }
        else
        {
            return redirect()->route('key.index')->withErrors('Game-key is invalid!');
        }
    }
}
