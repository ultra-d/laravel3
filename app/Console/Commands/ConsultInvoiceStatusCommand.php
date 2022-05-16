<?php

namespace App\Console\Commands;

use App\Actions\GetInvoiceInformation;
use App\Constants\PaymentStatus;
use App\Models\Invoice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ConsultInvoiceStatusCommand extends Command
{
    protected $signature = 'get:status';

    protected $description = 'Get invoice status (PENDING) to APPROVE OR FAILED';

    public function handle(): void
    {
        $invoices = Invoice::where('payment_status', PaymentStatus::PENDING)->get();

        if ($invoices->isNotEmpty()) {
            foreach ($invoices as $invoice) {
                Log::info($invoice->id . ' ' . $invoice->payment_status);
                (new GetInvoiceInformation())->getInformation($invoice);
            }
        }
    }
}
