<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class API extends Model
{
    use HasFactory;
    private $host = "http://api:5000/";

    /**
     * @param String $key # Game key to verify
     * @return bool # Returns True, if key is valid and false if not
     */
    public function verify_key(String $key): bool
    {
        try
        {
            $response = Http::get($this->host . '/verify/' . $key);
            return $response;
            #return $response->successful();
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }
}
