<?php $this->assign('title', 'ระบบจัดการแบนเนอร์'); ?>

<div class="container-fluid">
    <div class="row m-2 my-2 h-100 ">
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0">
            <div class="d-flex justify-content-between py-2 my-auto">
                <div>
                    <small class="text-muted">Banner Management Systems </small>
                    <h3 class="m-0 p-0">ระบบจัดการแบนเนอร์</h3>
                </div>
                <a href="/" class="m-0 p-0  text-reset my-auto">
                    <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
                </a>
            </div>
            <div class="row m-0 p-0 my-3">
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-success">
                        <h5 class="m-0 p-0 ">แบนเนอร์ทั้งหมด</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countBanner) ? $countBanner : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card bg-primary">
                        <h5 class="m-0 p-0 ">กำลังใช้งาน</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countActive) ? $countActive : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-sm-4 m-0 p-0">
                    <div class="m-1 py-4 p-2 card shadow-sm ">
                        <h5 class="m-0 p-0 ">หมดอายุ</h5>
                        <h6 class="text-right m-0 p-0 font-weight-bold">
                            <?= ($countUnActive) ? $countUnActive : 0; ?>
                            <span><small>/ รายการ</small></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12  col-12 p-0 p-sm-1 m-0 ">
            <div class="card  p-2 table-responsive-lg">
                <div class="col-12  d-sm-flex justify-content-end mb-2 m-0 p-0">
                    <div class="">
                        <a href="<?= $this->Url->build(['controller' => 'Banner', 'action' => 'add']) ?>" class="btn btn-primary m-1"><i class="fas fa-plus-circle"></i> เพิ่มแบนเนอร์</a>
                    </div>
                </div>
                <table id="example" class="table table-responsive-lg display-nowrap" style="width:100%">

                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รูปภาพปก</th>
                            <th>หัวข้อ</th>
                            <th>วันเริ่มต้น</th>
                            <th>วันสิ้นสุด</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner as $key => $data) : ?>
                            <tr class="shadow-sm">
                                <td width="10"><?= $key + 1 ?></td>
                                <td width="300">
                                    <a data-fslightbox href="<?php echo $this->Url->build($data->img, ['fullBase' => true]); ?>">
                                        <img style="object-fit:cover; height: 150px;width: 100%;" src="<?php echo $this->Url->build($data->img, ['fullBase' => true]); ?>">
                                    </a>
                                </td>
                                <td width="80">
                                    <h5 class="m-0 p-0 "><?= $data->title ?></a></h5>
                                    <small class="m-0 p-0 text-muted"><?= $data->date ?></small><br>
                                    <small class="m-0 p-0 text-muted"> <?= $data->user['name'] ?></small>
                                </td>
                                <td width="10">
                                    <?= $data->startdate ?>
                                </td>
                                <td width="10">
                                    <?= $data->enddate ?>
                                </td>
                                <td width="10">
                                    <?= ($data->status == 1 ? '<small class="badge badge-primary">เผยแพร่</small>' : '<small class="badge badge-danger">ไม่เผยแพร่</small>') ?>
                                </td>
                                <td width="10">
                                    <a href="<?= $this->Url->build(['controller' => 'Banner', 'action' => 'edit', $data->id]) ?>" type="button" class=" p-1 text-muted"><i class="fa-solid fa-pen-to-square"></i> </a>
                                    <a type="button" class="p-1 text-primary" onclick="viewsBanner(<?= $data->id ?>)"><i class="fas fa-circle-info"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="exampleModalLabel">
                    <p class="m-0 p-0">ข้อมูลแบนเนอร์</p>
                    <small class="text-muted">Banner Detail</small>
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
        $.LoadingOverlay("show");
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
                let data = resp.Banner
                html = ''
                html += `
                    <img class="w-100" src="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>${data['img']}" alt="">
                    <hr>
                    <p class="m-0 p-0 text-muted">หัวข้อ : <span class="text-dark">${data['title']}</span></p>
                    <p class="m-0 p-0 text-muted my-3">รายละเอียด <br>
                        <span class="text-dark">${data['detail']}</span>
                    </p>
                    <p class="m-0 p-0 text-muted">ลิงค์ : <span class="text-dark">${data['link']}</span></p>
                    <p class="m-0 p-0 text-muted">เหลืออีก : <span class="text-dark">${resp.CountDateEnd}</span> วัน</p>`

                $.LoadingOverlay("hide");
                $('#PreviewsData').html(html)
                $('#exampleModal').modal('show')
            }
        })
    }
</script>