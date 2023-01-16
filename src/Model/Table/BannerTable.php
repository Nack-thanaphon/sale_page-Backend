<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banner Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Banner newEmptyEntity()
 * @method \App\Model\Entity\Banner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Banner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Banner get($primaryKey, $options = [])
 * @method \App\Model\Entity\Banner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Banner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Banner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Banner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BannerTable extends Table
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

        $this->setTable('banner');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('detail')
            ->requirePresence('detail', 'create')
            ->notEmptyString('detail');

        $validator
            ->scalar('img')
            ->allowEmptyString('img');

        $validator
            ->scalar('link')
            ->allowEmptyString('link');

        $validator
            ->scalar('startdate')
            ->maxLength('startdate', 200)
            ->requirePresence('startdate', 'create')
            ->notEmptyString('startdate');

        $validator
            ->scalar('enddate')
            ->maxLength('enddate', 200)
            ->requirePresence('enddate', 'create')
            ->notEmptyString('enddate');

        $validator
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
