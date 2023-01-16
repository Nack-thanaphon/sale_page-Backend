<?php


namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;


/**
 * Systems Controller
 *
 * @property \App\Model\Table\SystemsTable $Systems
 * @method \App\Model\Entity\System[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SystemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $systems = $this->paginate($this->Systems);

        $this->set(compact('systems'));
    }

    /**
     * View method
     *
     * @param string|null $id System id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $id = $this->request->getData('id');
        $system = $this->Systems->get($id, [
            'contain' => ['Contact', 'Products'],
        ]);
        
        $this->set(compact('system'));
        $this->set('_serialize', ['system']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $system = $this->Systems->newEmptyEntity();
        if ($this->request->is('post')) {

            $system = $this->Systems->patchEntity($system, $this->request->getData());
            $hasher = new DefaultPasswordHasher();
            $mytoken = Security::hash(Security::randomBytes(32));
            $system->token = $mytoken;
            if ($this->Systems->save($system)) {
                $this->Flash->success(__('บันทึกสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('กรุณาลองใหม่อีกครั้ง'));
        }
        $this->set(compact('system'));
    }

    /**
     * Edit method
     *
     * @param string|null $id System id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $system = $this->Systems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $system = $this->Systems->patchEntity($system, $this->request->getData());
            if ($this->Systems->save($system)) {
                $this->Flash->success(__('บันทึกสำเร็จ'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('กรุณาลองใหม่อีกครั้ง'));
        }
        $this->set(compact('system'));
    }

    /**
     * Delete method
     *
     * @param string|null $id System id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $system = $this->Systems->get($id);
        if ($this->Systems->delete($system)) {
            $this->Flash->success(__('The system has been deleted.'));
        } else {
            $this->Flash->error(__('The system could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
