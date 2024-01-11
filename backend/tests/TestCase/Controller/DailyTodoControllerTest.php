<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Auth\JwtToken;
use App\Controller\DailyTodoController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\DailyTodoController Test Case
 *
 * @uses \App\Controller\DailyTodoController
 */
class DailyTodoControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.DailyTodo',
        'app.user',
    ];
    protected function setUp(): void
    {
        $data["id"]=1;
        $jwt=new JwtToken();
        $token=$jwt->generateToken($data);
        $this->configRequest([
            'headers' => ['Authorization' => 'Bearer '.$token],
        ]);
        parent::setUp();

    }
    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\DailyTodoController::index()
     */
    public function testIndex(): void
    {
        $this->get('api/todo/1.json');
        $this->assertResponseOk();
        $this->assertResponseContains('"user_id": 1');
        
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\DailyTodoController::view()
     */
    // public function testView(): void
    // {
    //     $this->markTestIncomplete('Not implemented yet.');
    // }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\DailyTodoController::add()
     */
    public function testAdd(): void
    {
        $this->post('api/todo/add.json',['story'=>"New data",'day'=>'moday','completed'=>'False','saved'=>1,'user_id'=>1]);
        $this->assertResponseCode(201);
        $this->assertResponseContains('"story": "New data"');    
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\DailyTodoController::edit()
     */
    public function testEdit(): void
    {
        $this->post('api/todo/edit/1.json',['story'=>"New data"]);
        $this->assertResponseOk();
        $this->assertResponseContains('"story": "New data"');    
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\DailyTodoController::delete()
     */
    public function testDelete(): void
    {
        $this->delete('api/todo/delete/1.json');
        $this->assertResponseCode(200); 
     }
}
