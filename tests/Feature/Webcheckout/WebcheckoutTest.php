<?php

namespace Tests\Feature\Webcheckout;

use App\Request\GetInformationRequest;
use App\Request\CreateSessionRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebcheckoutTest extends TestCase
{
    public function test_it_can_get_information_request(): void
    {
        $request = (new GetInformationRequest())->auth();
        $this->assertAuthSuccess($request);
    }

    public function test_it_can_get_create_session_request(): void
    {
        $request = (new CreateSessionRequest($this->getCreateSessionData()))->toArray();

        $this->assertAuthSuccess($request);
        $this->assertArrayHasKey('payment', $request);
        $this->assertArrayHasKey('expiration', $request);
        $this->assertArrayHasKey('locale', $request);
        $this->assertArrayHasKey('returnUrl', $request);
    }

    private function assertAuthSuccess(array $request): void
    {
        $this->assertArrayHasKey('auth', $request);
        $this->assertArrayHasKey('login', $request['auth']);
        $this->assertArrayHasKey('tranKey', $request['auth']);
        $this->assertArrayHasKey('nonce', $request['auth']);
        $this->assertArrayHasKey('seed', $request['auth']);
    }
    
    private function getCreateSessionData(): array
    {
        return [
            'payment' => [
                'reference' => 'TEST_1000',
                'description' => 'conexion con webcheckout desde un test',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '10000'
                ]
            ],
            'returnUrl' => route('customer.profile.index'),
            'expiration' => date('c', strtotime('+2 days')),
        ];
    }
}
