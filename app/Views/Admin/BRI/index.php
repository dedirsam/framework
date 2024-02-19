<style>
    #saldo-bri {
        cursor: pointer;
        /* Mengubah gaya kursor menjadi tangan saat diarahkan */
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title_page; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Warung</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between">
                                <div class="col-md-auto">
                                    <div class="time-label">
                                        Saldo BRI: Rp. <span id="saldo-bri" class="bg"> <?= number_format($saldo, 0, ',', '.'); ?> <span class="icon-edit"><i class="fas fa-edit"></i></span></span>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <button type="button" class="btn btn-block bg-gradient-primary btn-sm" onclick="tambah_saldo()">Isi Saldo</button>
                                </div>
                                <div class="col col-lg-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary btn-sm" onclick="add_kategori()">Tambah Transaksi</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:70px;">Kategori ID</th>
                                        <th>Nama KAtegori</th>
                                        <th style="width:225px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bri as $bri) { ?>
                                        <tr>
                                            <td><?php echo $bri->id; ?></td>
                                            <td></td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-auto">
                                                        <button class=" bg-gradient-warning btn-sm" onclick="edit_kategori(<?php echo $bri->id; ?>)">Edit</button>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <button class=" bg-gradient-danger btn-sm" onclick="delete_kategori(<?php echo $bri->id; ?>)">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kategori ID</th>
                                        <th>Nama KAtegori</th>
                                        <th style="width:125px;">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



<?php include(APPPATH . 'Views/Admin/BRI/ajax_bri.php'); ?>

<!-- Bootstrap modal isi saldo -->

<div class="modal fade" id="modal_form_saldo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Saldo</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="input-group col-md-9">
                            <div class="input-group-prepend ">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input name="sal_in" type="text" class="form-control" placeholder="Masukkan Jumlah">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="isi()" class="bg-gradient-primary btn-sm">Save</button>
                <button type="button" class="bg-gradient-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- modal edit saldo -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Koreksi Saldo <small>Rp. <?= number_format($saldo, 0, ',', '.'); ?></small>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="rubah" class="form-horizontal">
                    <input type="hidden" value="<?= $saldo; ?>" name="sal_end" />
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="input-group col-md-9">
                            <div class="input-group-prepend ">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input name="sal_end" type="text" class="form-control" placeholder="Masukkan Jumlah Koreksi">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="rubah()" class="bg-gradient-primary btn-sm">Save</button>
                <button type="button" class="bg-gradient-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- End Bootstrap modal -->