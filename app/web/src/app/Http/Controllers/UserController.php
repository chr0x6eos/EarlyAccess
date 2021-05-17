<?php

namespace App\Http\Controllers;

use App\Models\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GrahamCampbell\Throttle\Facades\Throttle;
//use App\Models\User;

class UserController extends Controller
{

    protected $timeout = 1; //1 minute timeout on too many requests

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /*
     * Unimplemented functions to manage user-accounts
     *
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

            if ($request->has('key'))
            {
                // Allow empty or working keys
                if ($request->key == "" || API::verify_key($request->key) == "Key is valid!")
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
            if (!$user)
                throw new \Exception('User does not exist!');

            //Only allow deletion if admin
            if (!Auth::user()->isAdmin())
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
    }*/

    public function download()
    {
        if (Auth::user()->isAdmin())
        {
            if (Storage::disk('local')->exists('backup.zip'))
                return Storage::download('backup.zip');
            else
                return redirect()->route('admin.backup')->withErrors('Critical ERROR: Backup was deleted! Please reset the box!');
        }
        else
            return redirect()->route('dashboard')->withErrors('You are not authorized to access this resource!');
    }

    public function add_key(Request $request)
    {
        $this->validate($request, [
            'key' => ['required', 'string', new \App\Rules\ValidKey],
        ]);

        // Throttle users to 60req/min = 1req/s
        $throttler = Throttle::get($request, 60, $this->timeout);

        if (!$throttler->attempt())
            return redirect()->route('key.index')->withErrors('Too many requests! Please wait (' . $this->timeout . ' min) before retrying!');

        $key = $request->key;
        $user = Auth::User();

        if ($user->isAdmin())
        {
            // Admin cannot add keys to his account, redirect
            return redirect()->route('key.index');
        }

        if (API::verify_key($key) === "Key is valid!")
        {
            $user->key = $key;
            $user->save();
            $throttler->clear();

            return redirect()->route('key.index')->withSuccess('Game-key successfully added to your account. Have fun playing!');
        }
        else
        {
            return redirect()->route('key.index')->withErrors('Game-key is invalid! If this issue persists, please contact the admin!');
        }
    }

    public function verify_key(Request $request)
    {
        $this->validate($request, [
            'key' => ['required', 'string'] , //new \App\Rules\ValidKey],
        ]);

        // Throttle admins to 600req/min = 10req/s
        $throttler = Throttle::get($request, 600, $this->timeout);

        if(!$throttler->attempt())
            return redirect()->route('key.index')->withErrors('Too many requests! Please wait (' . $this->timeout . ' min) before retrying!');

        $key = $request->key;
        $resp = API::verify_key($key);

        if ($resp === "Key is valid!")
        {
            return redirect()->route('key.index')->withSuccess('Game-key is valid!');
        }
        else
        {
            return redirect()->route('key.index')->withErrors('Game-key is invalid! DEBUG: ' . $resp);
        }
    }
}
