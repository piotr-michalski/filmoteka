<?php

namespace App\Tests;

use App\Service\GetMovies;
use PHPUnit\Framework\TestCase;

class GetMoviesTest extends TestCase
{
    private GetMovies $getMovies;

    protected function setUp(): void
    {
        $this->getMovies = new GetMovies();
    }

    public function testExecuteAllReturnsAllMovies(): void
    {
        $result = $this->getMovies->execute('all');

        $this->assertIsArray($result);
        $this->assertCount(85, $result);
    }

    public function testExecuteRandomReturnsThreeMovies(): void
    {
        $result = $this->getMovies->execute('random');

        $this->assertCount(3, $result);
        foreach ($result as $movie) {
            $this->assertIsString($movie);
        }
    }

    public function testExecuteWReturnsTitlesStartingWithWAndEvenLength(): void
    {
        $result = $this->getMovies->execute('w');

        $this->assertIsArray($result);
        foreach ($result as $title) {
            $this->assertStringStartsWithIgnoringCase($title);

            $titleWithoutSpaces = preg_replace('/\s+/', '', $title);
            $this->assertEquals(
                0,
                mb_strlen($titleWithoutSpaces) % 2,
                'Title '.$title.' has odd length without spaces'
            );
        }
    }

    public function testExecuteMultiwordReturnsOnlyMultiwordTitles(): void
    {
        $result = $this->getMovies->execute('multiword');

        $this->assertIsArray($result);
        foreach ($result as $title) {
            $this->assertGreaterThan(
                1,
                str_word_count($title, 0, 'ąćęłńóśźż'),
                'Title '.$title.' is not multiword'
            );
        }
    }

    public function testExecuteInvalidFilterReturnsAll(): void
    {
        $result = $this->getMovies->execute('invalid_filter');

        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }

    private function assertStringStartsWithIgnoringCase(string $actual): void
    {
        $this->assertEqualsIgnoringCase('w', mb_substr($actual, 0, 1));
    }
}