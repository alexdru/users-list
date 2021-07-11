<?php

namespace App\Services;

use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;
use App\Models\User;

class VKImportService
{
    protected VKApiClient $vkApiClient;

    /**
     * VKImportService constructor.
     */
    public function __construct()
    {
        $this->vkApiClient = app(VKApiClient::class);
    }
    /**
     * Get user's friends list
     *
     * @throws VKApiException
     * @throws VKClientException
     *
     * @return void
     */
    public function getFriendsList(): void
    {
        $accessToken = config('vk.token');
        $userId = config('vk.user_id');

        $response = $this->vkApiClient->friends()->get($accessToken, [
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
            $newUser
                ->addMediaFromUrl($url)
                ->toMediaCollection();

            $newUser->save();
        }
    }
}
