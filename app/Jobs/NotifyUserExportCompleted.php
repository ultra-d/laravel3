<?php

namespace App\Jobs;

use App\Notifications\ExportReady;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUserExportCompleted implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    public $user;
    public $filePath;

    public function __construct($user, $filePath)
    {
        $this->user = $user;
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        $this->user->notify(new ExportReady($this->filePath));
    }
}
