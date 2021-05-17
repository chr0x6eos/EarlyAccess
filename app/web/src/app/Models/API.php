<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class API extends Model
{
    use HasFactory;

    /**
     * Verifies a game-key using the API
     *
     * @param String $key // Game-key to verify
     * @return string //Returns response from API
     */
    public static function verify_key(String $key) : string
    {
        try
        {
            $response = Http::get('http://api:5000/verify/' . $key);
            if (isset($response["message"]))
                return $response["message"];
            else
                return $response->body();
        }
        catch (\Exception $ex)
        {
            return "Unkown error: " . $ex->getMessage();
        }
    }
}
