<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DailyTodo Entity
 *
 * @property int $id
 * @property string $day
 * @property string $story
 * @property bool|null $saved
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created_on
 *
 * @property \App\Model\Entity\User $user
 */
class DailyTodo extends Entity
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
        'day' => true,
        'story' => true,
        'saved' => true,
        'user_id' => true,
        'created_on' => true,
        'user' => true,
        'completed' => true,
    ];
}
