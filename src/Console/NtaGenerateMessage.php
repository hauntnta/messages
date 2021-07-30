<?php

namespace DevNta\Messages\Console;

use DevNta\Messages\Imports\MessageFileImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class NtaGenerateMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nta-message:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Base Core Message';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('start the import process');
        if (!empty(config('nta_message.path_url_file'))) {
            $file = config('nta_message.path_url_file');
        } else {
            $file = __DIR__ . '/../../public/assets/files/Library_Error_Message.xlsx';
        }
        if (!file_exists($file)) {
            $this->info('file not exits');
            die();
        }
        try {
            Excel::import(new MessageFileImport(), $file);
            $this->info('The import process has been completed.');
            $this->info('finish the import process');
        } catch (\Exception $e) {
            $this->line('<fg=red;bg=yellow>Import failed.</>');
            die();
        }
    }
}
