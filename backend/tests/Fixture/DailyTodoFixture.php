<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DailyTodoFixture
 */
class DailyTodoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'daily_todo';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'day' => 'Lorem ipsum d',
                'story' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'saved' => 1,
                'user_id' => 1,
                'created_on' => '2023-10-16 18:41:18',
            ],
        ];
        parent::init();
    }
}
