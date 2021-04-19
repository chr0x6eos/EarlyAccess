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

    public function edit($id)
    {
        try
        {
            $user = User::find($id);

            // Check if user was found
            if (!$user)
                throw new \Exception('User does not exist!');

            //Only show user to admins
            if (!Auth::user()->isAdmin())
                throw new \Exception('Only administrative users can edit users!');

            return view('admin.users.edit')->with('user', $user);
        }
        catch (\Exception $ex)
        {
            return redirect()->route('admin.index')->withErrors($ex->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            //Validate if send input is valid
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
            ]);

            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;

            //Check if difficulty has valid value
            if ($user->validRole($request->role))
            {
                $user->role = $request->role;
            }
            else
            {
                return redirect()->route('users.edit', $user)->withErrors('Invalid role value!');
            }

            if($request->has('key') && $request->key != "")
            {
                if ($user->verifyKey($request->key))
                {
                    $user->key = $request->key;
                }
                else
                {
                    return redirect()->route('users.edit', $user)->withErrors('Invalid game-key!');
                }
            }

            $user->save();

            return redirect()->route('users.index')->withSuccess('User successfully edited!');
        }
        catch (Exception $ex)
        {
            return redirect()->route('users.index')->withErrors($ex->getMessage());
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
