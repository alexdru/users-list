<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use JsonException;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Testing to get all users
     *
     * @see UserController::index()
     * @throws JsonException
     */
    public function testIndex(): void
    {
        $response = $this->get('/api/users');

        $structure = $this->getFileStructure('/responses/user/users-list.json');
        $response->assertJsonStructure($structure);
    }

    /**
     * Testing to get user data
     *
     * @see UserController::show()
     * @throws JsonException
     */
    public function testShow(): void
    {
        $userId = User::query()
            ->select('id')
            ->inRandomOrder()
            ->first();

        $response = $this->get("/api/user/$userId->id");

        $structure = $this->getFileStructure('/responses/user/user-data.json');
        $response->assertJsonStructure($structure);
    }
}
