<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Vk\Import;

class VkImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make import of users from vk';

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
     * Execute the vk import console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $vkImport = new Import;
        $vkImport->getFriendsList();
    }
}
