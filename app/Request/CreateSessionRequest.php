<?php

namespace App\Request;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CreateSessionRequest extends GetInformationRequest
{
    public array $payment;
    public string $expiration;
    public string $returnUrl;
    public array $buyer;

    public function __construct(array $data)
    {
        $this->buyer = $data['buyer'];
        $this->payment = $this->getPayment($data['payment']);
        $this->expiration = $this->getExpiration();
        $this->returnUrl = $data['payment']['redirectUrl'];
    }
    public static function url(?int $session_id = null): string
    {
        return config('webcheckout.url').'/api/session/';
    }

    public function toArray()
    {
        return array_merge(parent::auth(), [
            'locale' => 'es_CO',
            'buyer' => $this->buyer,
            'payment' => $this->payment,
            'expiration' => $this->expiration,
            'returnUrl' => $this->returnUrl,
            'ipAddress' => app(Request::class)->getClientIp(),
            'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255)
        ]);
    }

    public function getPayment($data)
    {
        return [
            'reference' => $data['reference'],
            'description' => 'Pago con referencia numero '. $data['reference'],
            'amount' => [
                'currency' => 'COP',
                'total' => $data['total']
            ]
        ];
    }

    public function getExpiration()
    {
        return date('c', strtotime('+2 days'));
    }
}
