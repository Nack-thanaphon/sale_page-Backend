<?php $this->assign('title', 'อัพเดตข่าว'); ?>


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
            <?= $this->Form->create($system) ?>
            <div class="form-group">
                <div class="d-flex justify-content-between py-2 my-auto">
                    <h3 class="font-weight-bold"><?= __('อัพเดตระบบใช้งาน') ?></h3>
                    <h6 class="fas fa-trash-alt my-auto" type="button" onclick="deletePosts(<?= $system->id ?>)"></h6>
                </div>
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
                                <input class="form-check-input" type="radio" name="status" value='1' <?= $system->status == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    เผยแพร่
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value='0' <?= $system->status == 0 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    ไม่เผยแพร่
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
</div>

<script>
    function deletePosts(id) {
        Swal.fire({
            title: 'คุณแน่ใจใช่ไหม?',
            text: "คุณต้องการลบข้อมูล " + id + " ใช่ไหม !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= $this->Url->build(['controller' => 'systems', 'action' => 'delete']) ?>",
                    type: "post",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
                    },
                })
                Swal.fire(
                    'ลบเรียบร้อย!',
                    'ดำเนินการเรียบร้อย.',
                    'success'
                )
                window.location = ('<?= $this->Url->build(['action' => 'index']) ?>')
            }
        })
    }
</script>