<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

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
     * Execute the console command.
     *
     * @return bool
     * @throws VKApiException
     * @throws VKClientException
     */
    public function handle(): bool
    {
        $accessToken = env('VK_ACCESS_TOKEN');
        $userId = env('VK_USER_ID');

        $vk = new VKApiClient();
        $response = $vk->friends()->get($accessToken, [
            'user_id' => $userId,
            'order' => 'random',
            'fields' => ['photo_400_orig']
        ]);

        foreach ($response['items'] as $item) {
            $newUser = User::firstOrNew([
                'name' => $item['first_name'] . ' ' . $item['last_name'],
                'email' => $item['email'] ?? NULL,
            ]);
            $url = $item['photo_400_orig'];
            $photo = $newUser
                ->addMediaFromUrl($url)
                ->toMediaCollection();
            $newUser->photo = $photo->getFullUrl();

            $result = $newUser->save();
        }

        return $result;
    }
}
