<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JsonException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Getting response structure from file
     *
     * @param string $responseSamplePath
     * @return array
     * @throws JsonException
     */
    protected function getFileStructure(string $responseSamplePath): array
    {
        $responseStructurePath = storage_path() . $responseSamplePath;
        $responseStructure = file_get_contents($responseStructurePath);
        $responseStructureDecoded = json_decode($responseStructure, true, 512, JSON_THROW_ON_ERROR);

        return array_keys($responseStructureDecoded);
    }
}
