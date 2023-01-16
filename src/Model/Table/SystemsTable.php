<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Systems Model
 *
 * @property \App\Model\Table\ContactTable&\Cake\ORM\Association\HasMany $Contact
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\System newEmptyEntity()
 * @method \App\Model\Entity\System newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\System[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\System get($primaryKey, $options = [])
 * @method \App\Model\Entity\System findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\System patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\System[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\System|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\System saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\System[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\System[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\System[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\System[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SystemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('systems');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Contact', [
            'foreignKey' => 'system_id',
        ]);
        $this->hasMany('Products', [
            'foreignKey' => 'system_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('path')
            ->requirePresence('path', 'create')
            ->notEmptyString('path');

        $validator
            ->scalar('token')
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}
