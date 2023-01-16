<?php $this->assign('title', 'ระบบใช้งาน'); ?>

<div class="container-fluid">
    <div class="row m-2 my-2 h-100 ">
        <div class="col-sm-12  col-12">
            <div class="py-2">
                <small class="text-muted">System Management Systems </small>
                <h3 class="m-0 p-0">จัดการระบบใช้งาน</h3>
            </div>
            <!-- <div class="row  my-3">
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 p-3 card bg-success">
                        <h5 class="m-0 p-0 ">ระบบใช้งานทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= $this->Custom->countProduct(); ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-6 col-sm-4 m-0 p-0">
                    <div class="m-1 p-3 card bg-primary">
                        <h5 class="m-0 p-0 ">ประเภทระบบใช้งานทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= $this->Custom->countProductType(); ?>
                            <span><small>/ ประเภท</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-6 col-sm-4 m-0 p-0">
                    <div class="m-1 p-3 card shadow-sm ">
                        <h5 class="m-0 p-0 ">ยอดเข้าชมทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= $this->Custom->countPromotion(); ?>
                            <span><small>/ ครั้ง</small></span>
                        </h6>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-sm-12  col-12 ">
            <div class="card  p-2 table-responsive-lg">
                <div class="col-12  d-sm-flex justify-content-end mb-2 m-0 p-0">
                    <div class="">
                        <a href="<?= $this->Url->build(['controller' => 'systems', 'action' => 'add']) ?>" class="btn btn-primary m-1">เพิ่มระบบใช้งาน</a>
                    </div>
                </div>
                <table id="example" class="table table-responsive-lg display-nowrap " style="width:100%">

                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อระบบใช้งาน</th>
                            <th>ลิงค์เว็บไซต์</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($systems as $key => $system) : ?>

                            <tr class="shadow-sm">
                                <td width="5">
                                    <h5 class="m-0 p-0 "><?= $key + 1 ?></a></p>
                                </td>
                                <td width="30">
                                    <h5 class="m-0 p-0 text-primary"><?= $system->name ?></a></h5>
                                    <!-- <small class="m-0 p-0 text-muted">TOKEN : <?= $system->token ?></small> -->
                                </td>
                                <td width="10">
                                    <small class="m-0 p-0 text-muted"><?= $system->path ?></small><br>
                                </td>
                                <td width="10">
                                    <?= ($system->status == 1 ? '<small class="badge badge-primary">เผยแพร่</small>' : '<small class="badge badge-danger">ไม่เผยแพร่</small>') ?>
                                </td>
                                <td width="10">
                                    <a href="<?= $this->Url->build(['controller' => 'Systems', 'action' => 'edit', $system->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                    <a type="button" class="p-1 text-primary" onclick="viewsBanner(<?= $system->id ?>)"><i class="fas fa-circle-info"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="exampleModalLabel">
                    <p class="m-0 p-0">ข้อมูลระบบ</p>
                    <small class="text-muted">Systems Detail</small>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12" id="PreviewsData">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewsBanner(id) {

        $.ajax({
            url: "<?= $this->Url->build(['action' => 'view']) ?>",
            type: "post",
            dataType: 'json',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(resp) {
                let data = resp.system
                html = ''
                html += `
                    <span class="m-0 p-0 text-muted">หัวข้อ :</span>
                    <h3 class="text-primary">${data['name']}</h3>
                    <p class="m-0 p-0 text-muted">ลิงค์ : </p>
                    <h6 class="text-dark">${data['path']}</span>
                    <hr>
                    <p class="m-0 p-0 text-muted">สร้างเมือ : <span class="text-dark">${data['created']}</span></p>
                    
                    
                    `
                $('#PreviewsData').html(html)
                $('#exampleModal').modal('show')
            }
        })
    }
    $(document).ready(function() {
        var t = $('#example').DataTable({
            responsive: true,
        });

    });
</script>