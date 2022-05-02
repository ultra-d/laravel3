<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Request\GetInformationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class GetInvoiceInformation
{
    public function execute(Model $invoice): void
    {
        $this->getInformation($invoice);
    }

    public function getInformation(Invoice $invoice)
    {
        if ($invoice->payment_status == 'PENDING' || is_null($invoice->payment_status)) {
            $session_id = $invoice->payment_reference;
            $session = new GetInformationRequest();

            $response = Http::post(GetInformationRequest::url($session_id), $session->auth());

            if ($response->ok()) {
                $responseData = $response->json();
                if (isset($responseData['status'], $responseData['status']['status'])) {
                    $invoice->payment_status = $responseData['status']['status'];
                    $invoice->save();
                    /* modify DB:PRODUCTS */
                    if ($responseData['status']['status'] == 'APPROVED') {
                        foreach ($invoice->products as $product) {
                            $product->quantity = $product->quantity - $product->pivot->quantity;
                            $product->save();
                        }
                    }
                }
            }
        }
    }
}
