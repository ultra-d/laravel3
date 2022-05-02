<?php

namespace App\Request;

use App\Contracts\WebcheckoutRequestContract;
use Illuminate\Support\Str;

class GetInformationRequest implements WebcheckoutRequestContract
{
    public function auth()
    {
        $seed = date('c');
        $nonce = Str::random(8);
        $trankey = base64_encode(
            hash('sha1', $nonce.$seed.config('webcheckout.tranKey'), true)
        );

        /* Return data needed in the body to getInfo  */
        return [
            'auth' =>
            [
                'login' => config('webcheckout.login'),
                'tranKey' => $trankey,
                'nonce' => base64_encode($nonce),
                'seed' => $seed,
            ],
        ];
    }

    public static function url(?int $session_id): string
    {
        return config('webcheckout.url').'/api/session/'.$session_id;
    }
}
