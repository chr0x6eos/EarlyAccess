<?php

namespace App\Http\Controllers;

use App\Models\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GrahamCampbell\Throttle\Facades\Throttle;

class UserController extends Controller
{

    protected $timeout = 1; //1 minute timeout on too many requests

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

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
