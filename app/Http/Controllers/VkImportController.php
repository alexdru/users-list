<?php

namespace App\Http\Controllers;

use App\Models\User;
use VK\Client\VKApiClient;

class VkImportController extends Controller
{
    /**
     * Parse and save users
     *
     * @return bool
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    function store()
    {
        $accessToken = env('VK_ACCESS_TOKEN');

        $vk = new VKApiClient();
        $response = $vk->friends()->get($accessToken, [
            'user_id' => 143209536,
            'order' => 'random',
            'fields' => ['photo_400_orig']
        ]);

        foreach ($response['items'] as $item) {
            $newUser = new User;
            $newUser->name = $item['first_name'] . ' ' . $item['last_name'];
            $newUser->email = $item['email'] ?? NULL;
            $url = $item['photo_400_orig'];
            $newUser
                ->addMediaFromUrl($url)
                ->toMediaCollection();

            $result = $newUser->save();
        }

        return $result;
    }
}
