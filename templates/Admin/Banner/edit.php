<?php $this->assign('title', 'อัพเดตแบนเนอร์'); ?>

<div class="row my-3 m-2">
    <div class="col-12 d-flex justify-content-between">
        <div>
            <small class="text-muted">Update Banner Systems </small>
            <h3 class="m-0 p-0">อัพเดตแบนเนอร์</h3>
        </div>
        <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="m-0 p-0  text-reset my-auto">
            <h3 class="fas fa-arrow-alt-circle-left my-auto"></h3>
        </a>

    </div>

    <div class="col-12 col-md-12 col-lg-12 card">
        <div class="row p-3">
            <div class="form-group col-12 col-sm-12 my-auto ">
                
                <?= $this->Form->create($banner, ["enctype" => "multipart/form-data"]); ?>
                <div class="d-flex justify-content-between py-2 my-auto">
                    <input type="file" name="img" class="mb-3" id="bannerImg">
                    <input type="hidden" name="fileOld" class=" mb-3" value="<?= $banner->img ?>">
                    <h6 class="fas fa-trash-alt my-auto" type="button" onclick="deletePosts(<?= $banner->id ?>)"></h6>
                </div>
                <?php if (!empty($banner->img)) { ?>
                    <img style="object-fit:cover; height: 400px;width: 100%;" id="bannerImgPreviews" class="py-2" src="<?= $this->Url->build($banner->img) ?>">
                <?php } else { ?>
                    <img style="object-fit:cover; height: 400px;width: 100%;" id="bannerImgPreviews" class="py-2" hidden>
                <?php } ?>
                <div class="form-floating my-3">
                    <label for="floatingemail">หัวข้อแบนเนอร์</label>
                    <?= $this->Form->input('title', ['class' => 'form-control ', 'placeholder' => 'หัวข้อแบนเนอร์']); ?>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlTextarea1">รายละเอียด</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="detail" placeholder="รายละเอียด"><?= $banner->detail ?></textarea>
                </div>
                <div class="form-floating mb-3">
                    <label for="floatingemail">ลิงค์ (*ถ้ามี)</label>
                    <?= $this->Form->input('link', ['class' => 'form-control ', 'placeholder' => 'ลิงค์อื่นๆ']); ?>
                </div>
                <div class="row m-0 p-0">
                    <div class="col-12 col-sm-6">
                        <div class="form-floating mb-1">
                            <label>วันเริ่มต้น</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="startdate" class="form-control addnew" value="<?= $banner->startdate ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-floating mb-1">
                            <label>วันสิ้นสุด</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="enddate" class="form-control addnew" value="<?= $banner->enddate ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 text-muted d-flex justify-content-end">
                        <small>เหลืออีก : <span><?= ($ContDateleft <= 0) ? '0' : $ContDateleft ?> วัน</span> </small>
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="form-floating mb-3">
                        <label for="floatingemail">สถานะการใช้งาน</label>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" name="status" value='1' <?= ($banner->status == 1) ? 'checked' : '' ?>>
                            <label class="form-check-label text-success" for="flexRadioDefault1">
                                เปิดการใช้งาน
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value='0' <?= ($banner->status == 0) ? 'checked' : '' ?>>
                            <label class="form-check-label " for="flexRadioDefault2">
                                ปิดการใช้งาน
                            </label>
                        </div>
                    </div>
                </div>
                <?= $this->Form->button(__('บันทึกข้อมูล'), ['class' => 'btn btn-primary w-100 mt-2 m-0']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#bannerImgPreviews').attr('src', e.target.result);
                    $('#bannerImgPreviews').attr('hidden', false);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#bannerImg").change(function() {
            readURL(this);
        });
    })
    $(function() {
        $(".addnew").datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'dd-m-yyyy',
            autoclose: true,
            todayHighlight: true
        })
    });

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
                    url: "<?= $this->Url->build(['controller' => 'banner', 'action' => 'delete']) ?>",
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