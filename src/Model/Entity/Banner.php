<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banner Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $detail
 * @property string|null $img
 * @property string|null $link
 * @property string $startdate
 * @property string $enddate
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\User $user
 */
class Banner extends Entity
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
        'user_id' => true,
        'title' => true,
        'detail' => true,
        'img' => true,
        'link' => true,
        'startdate' => true,
        'enddate' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'user' => true,
    ];
}
