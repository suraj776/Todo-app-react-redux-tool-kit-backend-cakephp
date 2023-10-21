<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DailyTodoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DailyTodoTable Test Case
 */
class DailyTodoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DailyTodoTable
     */
    protected $DailyTodo;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.DailyTodo',
        'app.User',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DailyTodo') ? [] : ['className' => DailyTodoTable::class];
        $this->DailyTodo = $this->getTableLocator()->get('DailyTodo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DailyTodo);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DailyTodoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DailyTodoTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
