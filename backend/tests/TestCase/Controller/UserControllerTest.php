<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Auth\JwtToken;
use App\Controller\UserController;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UserController Test Case
 *
 * @uses \App\Controller\UserController
 */
class UserControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.User',
        'app.DailyTodo',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\UserController::index()
     */
    public function testAuth(): void
    {
        // $defaultConnection = ConnectionManager::get('default');

        // // Get the current database name
        // $currentDatabase = $defaultConnection->config()['database'];
        // debug($currentDatabase);
        $this->configRequest([
            'headers' => ['Content-Type' => 'multipart/form-data'],
        ]);
        $this->post('/api/signup.json',['name'=>'suraj','username'=>'test3@test.com','password'=>'admin@123','confirmPassword'=>'admin@123']);
        $this->assertResponseCode(201);
        $this->post('/api/login.json',['username'=>'test3@test.com','password'=>'admin@123']);
        $this->assertResponseOk();
        $this->assertResponseContains('token');

    }

    // /**
    //  * Test view method
    //  *
    //  * @return void
    //  * @uses \App\Controller\UserController::view()
    //  */
    // public function testView(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    // /**
    //  * Test add method
    //  *
    //  * @return void
    //  * @uses \App\Controller\UserController::add()
    //  */
    // public function testAdd(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    // /**
    //  * Test edit method
    //  *
    //  * @return void
    //  * @uses \App\Controller\UserController::edit()
    //  */
    // public function testEdit(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    // /**
    //  * Test delete method
    //  *
    //  * @return void
    //  * @uses \App\Controller\UserController::delete()
    //  */
    // public function testDelete(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }
}
