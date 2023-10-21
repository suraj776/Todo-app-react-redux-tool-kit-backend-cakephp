<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\DailyTodo[] $daily_todo
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'username' => true,
        'password' => true,
        'created_on' => true,
        'daily_todo' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
    
    public function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
    
    
    public function _setCreatedOn($created_on)
    {
        $datetime = new \DateTime(); // Current date and time
        
        // Format the datetime to match MySQL datetime format
        $formattedDatetime = $datetime->format('Y-m-d H:i:s');
        return $formattedDatetime;
    }
}
