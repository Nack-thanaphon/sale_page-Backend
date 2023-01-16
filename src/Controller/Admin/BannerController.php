<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Banner Controller
 *
 * @property \App\Model\Table\BannerTable $Banner
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BannerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $countBanner = $this->Custom->countBanner();
        $countActive = $this->Custom->countActive();
        $countUnActive = $this->Custom->countUnActive();
        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['Banner.id' => 'desc']
        ];
        $banner = $this->paginate($this->Banner);
        // pr($countBanner);
        // die;
        $this->set(compact(
            'banner',
            'countBanner',
            'countActive',
            'countUnActive'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {

        $id = $this->request->getData('id');
        $Banner = $this->Banner->find()
            ->select([
                'startdate' => 'Banner.startdate',
                'enddate' => 'Banner.enddate',
                'img' => 'Banner.img',
                'title' => 'Banner.title',
                'detail' => 'Banner.detail',
                'link' => 'Banner.link',
            ])
            ->where([
                'Banner.id' => $id
            ])
            ->first();

        $CountDateEnd = $this->getDateEndInt($Banner['enddate']);

        $this->set(compact('Banner','CountDateEnd'));
        $this->set('_serialize', ['Banner','CountDateEnd']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banner = $this->Banner->newEmptyEntity();

        if ($this->request->is('post')) {
            $banner = $this->Banner->patchEntity($banner, $this->request->getData());
            $BannerImg = $this->request->getData("img");
            $fileName = $BannerImg->getClientFilename();
            $fileType = $BannerImg->getClientMediaType();

            $BannerImgData = '';
            if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                $imagePath = WWW_ROOT . "img/banner/" . DS . $fileName;
                $BannerImg->moveTo($imagePath);
                $BannerImgData = "img/banner/" . $fileName;
            }
            $banner->img = $BannerImgData;
            $banner->user_id = $this->getUsersId();
            
   
            if ($this->Banner->save($banner)) {
                $this->Flash->success(__('บันทึกสำเร็จ'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('บันทึกไม่สำเร็จ'));
        }
        $users = $this->Banner->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('banner'));
    }
    public function getUsersId()
    {
        $session = $this->request->getSession();
        $userloginsession =  $session->read('userlogin');
        return $userloginsession['id'];
    }

    /**
     * Edit method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $banner = $this->Banner->get($id, [
            'contain' => [],
        ]);
     
        $ContDateleft = $this->getDateEndInt($banner['enddate']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banner->patchEntity($banner, $this->request->getData());

            $BannerImg = $this->request->getData("img");
            $BannerfileOld = $this->request->getData("fileOld");

            $BannerImgData = '';
            if ($BannerImg->getError() == 0) {
                $fileName = $BannerImg->getClientFilename();
                $fileType = $BannerImg->getClientMediaType();
                if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                    $imagePath = WWW_ROOT . "img/banner/" . DS . $fileName;
                    $BannerImg->moveTo($imagePath);
                    $BannerImgData = "img/banner/" . $fileName;
                }
                $banner->img = $BannerImgData;
                $banner->user_id = $this->getUsersId();

                if ($this->Banner->save($banner)) {

                    $this->Flash->success(__('บันทึกสำเร็จ'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('บันทึกไม่สำเร็จ'));
            } else {
                $banner->img = $BannerfileOld;
                if ($this->Banner->save($banner)) {
                    $this->Flash->success(__('บันทึกสำเร็จ'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('บันทึกไม่สำเร็จ'));
            }
        }
        $users = $this->Banner->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('banner', 'users','ContDateleft'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $banner = $this->Banner->get($id);
        if ($this->Banner->delete($banner)) {
            $this->Flash->success(__('ลบข้อมูลสำเร็จ'));
        } else {
            $this->Flash->error(__('ลบข้อมูลไม่สำเร็จ'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
