<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function show($id)
    {
        try
        {
            $message = Message::find($id);

            if (!$message)
                throw new \Exception('Message not found!');

            //Only show the message if user is sender or recipient
            if (Auth::user()->isSender($message->id) || Auth::user()->isRecipient($message->id))
            {
                // Mark as read if user is recipient
                if(Auth::user()->isRecipient($message->id))
                {
                    //Mark message as read upon rendering webpage
                    $message->read();
                }
                return view('messages.show')->with('message', $message);
            }
            return redirect()->route('messages.index');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('messages.index')->withErrors($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try
        {
            $this->validate($request, [
                'email' => 'required',
                'message' => 'required',
                'subject' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user)
                throw new \Exception("Could not find the user you are trying to message! Please verify the recipient: " . $request->email);

            // Send message to user
            Auth::user()->sendMessage($user->id, $request->message, $request->subject);

            return redirect()->route('messages.sent')->withSuccess('Message to ' . $request->email . ' has been send successfully!');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('contact.index')->withErrors("Cannot send message because of error: " . $ex->getMessage() . "!");
        }
    }

    public function destroy($id)
    {
        try
        {
            $message = Message::findOrFail($id);

            //Only allow deletion of the message if user is sender or recipient
            if (Auth::user()->isSender($message->id) || Auth::user()->isRecipient($message->id))
            {
                $message->delete();
                return redirect()->route('messages.index')->withSuccess('Successfully deleted message!');
            }
            else
            {
                return redirect()->route('dashboard')->withErrors('You are not authorized to delete this message!');
            }

        }
        catch (\Exception $exception)
        {
            return redirect()->route('messages.index')->withErrors('Error occurred on deletion!');
        }
    }

    public function reply($id)
    {
        try
        {
            $message = Message::find($id);

            if(!$message)
                throw new \Exception('Could not find the message to reply to!');

            // Only allow replies if user is recipient of message
            if (!Auth::user()->isRecipient($message->id))
            {
                throw new \Exception('Can not reply to a message that you are not the recipient of!');
            }

            $user = User::find($message->sender->id);
            if (!$user)
                throw new \Exception('Could not find user to reply to!');

            return redirect('contact')->with(['email' => $user->email, 'subject' => 'RE: ' . $message->subject]);
        }
        catch(\Exception $ex)
        {
            return redirect()->route('contact.index')->withErrors($ex->getMessage());
        }
    }
}
