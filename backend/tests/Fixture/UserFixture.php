<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserFixture
 */
class UserFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'user';
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
                'name' => 'suraj kumar',
                'username' => 'test@test.com',
                'password' => 'admin@123',
                'created_on' => '2023-10-14 07:19:31',
            ],
        ];
        parent::init();
    }
}
