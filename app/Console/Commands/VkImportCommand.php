<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\VkImportService;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class VkImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:import';

    protected VkImportService $vkImportService;

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
        $this->vkImportService = app(VkImportService::class);
    }

    /**
     * Execute the vk import console command.
     *
     * @throws VKApiException
     * @throws VKClientException
     *
     * @return void
     */
    public function handle(): void
    {
        $this->vkImportService->getFriendsList();
    }
}
