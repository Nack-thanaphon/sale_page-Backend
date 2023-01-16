<?php
$cakeDescription = 'AUN-HPN | ';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', $this->Url->Image('logo.png')) ?>
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <?= $this->Html->css(['back_end.css']) ?>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <?= $this->element('/utility/toastNotificationBackend'); ?>

    <!-- datatable -->


    <?= $this->Html->css(['bootstrap-4.min.css']) ?>
    <?= $this->Html->script("adminlte.js"); ?>
    <?= $this->Html->css(['adminlte.min.css']) ?>
    <?= $this->Html->css(['OverlayScrollbars.min.css']) ?>
    <?= $this->Html->css(['fullcalendar.min.css']) ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <script>
        // $.LoadingOverlay("show");
    </script>
    <div class="wrapper">
        <?php echo $this->Flash->render(); ?>
        <?= $this->element('/component/sidebar') ?>
        <?= $this->element('/component/back_navbar') ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row m-0">
                        <div class="col-12 m-0 p-0">
                            <?= $this->fetch('content') ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <?= $this->Html->script("plugins/jquery-ui/jquery-ui.min.js"); ?>

        <?= $this->Html->script("plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>
        <?= $this->Html->script("plugins/sparklines/sparkline.js"); ?>
        <?= $this->Html->script("plugins/jqvmap/jquery.vmap.min.js"); ?>
        <?= $this->Html->script("plugins/jqvmap/maps/jquery.vmap.usa.js"); ?>
        <?= $this->Html->script("plugins/jquery-knob/jquery.knob.min.js"); ?>
        <?= $this->Html->script("plugins/moment/moment.min.js"); ?>
        <?= $this->Html->script("plugins/daterangepicker/daterangepicker.js"); ?>
        <?= $this->Html->script("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"); ?>
        <?= $this->Html->script("plugins/summernote/summernote-bs4.min.js"); ?>
        <?= $this->Html->script("overlayScrollbars.min.js"); ?>
        <?= $this->Html->script("custom.js"); ?>

        <?= $this->Html->script("plugins/fullcalendar/lib/moment.min.js"); ?>
        <?= $this->Html->script("plugins/fullcalendar/fullcalendar.min.js"); ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <script>
            $.LoadingOverlay("hide");
        </script>
        <?= $this->Html->script("fslightbox.js"); ?>
        <?= $this->Html->script("custom.js"); ?>

    </div>

</body>

</html>