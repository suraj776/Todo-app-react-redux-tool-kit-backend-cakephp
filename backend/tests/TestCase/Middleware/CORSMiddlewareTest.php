<?php
declare(strict_types=1);

namespace App\Test\TestCase\Middleware;

use App\Middleware\CORSMiddleware;
use Cake\TestSuite\TestCase;

/**
 * App\Middleware\CORSMiddleware Test Case
 */
class CORSMiddlewareTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Middleware\CORSMiddleware
     */
    protected $CORS;

    /**
     * Test process method
     *
     * @return void
     * @uses \App\Middleware\CORSMiddleware::process()
     */
    public function testProcess(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
