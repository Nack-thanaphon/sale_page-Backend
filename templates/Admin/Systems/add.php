<?php $this->assign('title', 'เพิ่มข่าว'); ?>


<style>
    label#largeFile:after {
        position: absolute;
        width: 100%;
        max-width: 800px;

    }

    label#largeFile input#file {
        width: 0px;
        height: 0px;
    }
</style>
<div class="row my-3">
    <?= $this->Html->link(__('กลับไป'), ['action' => 'index'], ['class' => 'col-12 d-flex justify-content-end mb-2']) ?>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card p-3">
            <?= $this->Form->create($system, ["enctype" => "multipart/form-data"]) ?>
            <div class="form-group">
                <h3 class="font-weight-bold"><?= __('เพิ่มระบบใช้งาน') ?></h3>
               
                <div class="form-floating mb-2">
                    <label>หัวข้อ</label>
                    <?= $this->Form->input('name', ['class' => 'form-control ', 'placeholder' => 'ชื่อระบบ']); ?>
                </div>
                <div class="form-floating mb-2">
                    <label>ลิงค์ใช้งาน</label>
                    <?= $this->Form->input('path', ['class' => 'form-control ', 'placeholder' => 'ลิงค์เว็บไซต์ || URL']); ?>
                </div>
                <div class=" row m-0 p-0 ">
                    <div class="col-12 col-sm-12 m-0 p-0">
                        <div class="form-floating mb-1">
                            <label>สถานะระบบใช้งาน</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='1' checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    เผยแพร่
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='0'>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    ไม่เผยแพร่
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">บันทึกข้อมูล</button>

        </div>
    </div>
</div>
