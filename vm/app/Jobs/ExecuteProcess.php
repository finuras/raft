<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Inspiring;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\Process\Process;
use Throwable;

class ExecuteProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Activity $activity,
        public string $command = 'php artisan inspire',
        public ?string $cwd = null,
    ){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Process::fromShellCommandline($this->command, $this->cwd, null, null, 60)
            ->setTimeout(300)
            ->run(function ($type, $buffer) {
                // TODO Needs to be optimized. E.g., save to database/file once per second, not on every data buffer.
                $this->activity->description .= $buffer;
                $this->activity->output .= $buffer;
                $this->activity->save();
            });

        $this->activity->description .= "\n\nFinished.";
        $this->activity->properties = $this->activity->properties->merge(['status' => 'finished']);
        $this->activity->save();
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        $this->activity->properties = $this->activity->properties->merge(['status' => 'failed']);
        $this->activity->save();
    }
}
