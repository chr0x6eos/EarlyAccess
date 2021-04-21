<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class API extends Model
{
    use HasFactory;

    /**
     * @param String $key # Game-key to verify
     * @return bool
     */
    public static function verify_key(String $key) : string
    {
        try
        {
            $response = Http::get('http://api:5000/verify/' . $key);
            return $response["message"];
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }
}
