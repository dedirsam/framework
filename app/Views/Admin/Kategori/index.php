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
                                    <h3 class="card-title">Kategori Transaksi</h3>
                                </div>
                                <div class="col col-lg-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary btn-sm" onclick="add_kategori()">Tambah Kategori</button>
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
                                    <?php foreach ($kategori as $kat) { ?>
                                        <tr>
                                            <td><?php echo $kat->id; ?></td>
                                            <td> <?php echo $kat->nama_kategori; ?></td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-auto">
                                                        <button class=" bg-gradient-warning btn-sm" onclick="edit_kategori(<?php echo $kat->id; ?>)">Edit</button>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <button class=" bg-gradient-danger btn-sm" onclick="delete_kategori(<?php echo $kat->id; ?>)">Delete</button>
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

<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.css">

<script>
    $(function() {
        // $("#table_id").DataTable({
        //   "responsive": true,
        //   "lengthChange": false,
        //   "autoWidth": false,
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#table_id_wrapper .col-md-6:eq(0)');
        $('#table_id').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#table_id_wrapper .col-md-6:eq(0)');
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
    });

    var save_method; //for save method string
    var table;

    function add_kategori() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_kategori(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Admin/Kategori/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('[name="id"]').val(data.id);
                $('[name="nama_kategori"]').val(data.nama_kategori);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
            },

            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    }

    // function save() {
    //     var url;
    //     if (save_method == 'add') {
    //         url = "<?php echo site_url('Admin/Kategori/add') ?>";
    //     } else {
    //         url = "<?php echo site_url('Admin/Kategori/update') ?>";
    //     }
    //     // ajax adding data to database
    //     $.ajax({
    //         url: url,
    //         type: "POST",
    //         data: $('#form').serialize(),
    //         dataType: "JSON",
    //         success: function(data) {
    //             //if success close modal and reload ajax table
    //             $('#modal_form').modal('hide');
    //             location.reload(); // for reload a page
    //         },

    //         error: function(jqXHR, textStatus, errorThrown) {
    //             alert('Error adding / update data');
    //         }
    //     });
    // }
    function save() {
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('Admin/Kategori/add') ?>";
        } else {
            url = "<?php echo site_url('Admin/Kategori/update') ?>";
        }
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(response) {
                if (response.status == true) {
                    // Jika validasi berhasil, tampilkan Sweet Alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Jika pengguna menekan tombol "OK", tutup modal dan muat ulang halaman
                        if (result.isConfirmed) {
                            $('#modal_form').modal('hide');
                            location.reload();
                        }
                    });
                } else {
                    // Jika validasi gagal, tampilkan Sweet Alert dengan pesan validasi
                    Swal.fire({
                        title: 'Error!',
                        text: response.message, // Pesan validasi dari server
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / updating data');
            }
        });
    }



    // function delete_kategori(id) {

    //     if (confirm('Are you sure delete this data?')) {
    //         // ajax delete data from database
    //         $.ajax({
    //             url: "<?php echo site_url('Admin/Kategori/delete') ?>/" + id,
    //             type: "POST",
    //             dataType: "JSON",
    //             success: function(data) {
    //                 location.reload();
    //             },

    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 alert('Error deleting data');
    //             }

    //         });
    //     }
    // }

    function delete_kategori(id) {
        // Use Sweet Alert for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // ajax delete data from database
                $.ajax({
                    url: "<?php echo site_url('Admin/Kategori/delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        // Use Sweet Alert for success notification with a delay of 3 seconds
                        setTimeout(function() {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Data has been deleted successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        }, 3000); // 3000 milliseconds = 3 seconds

                        // Reload the page immediately
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        });
    }
</script>

<!-- Bootstrap modal -->

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Form Tambah</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">Nama Kategori</label>
                            <div class="col-md-9">
                                <input name="nama_kategori" placeholder="Nama Kategori" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="bg-gradient-primary btn-sm">Save</button>
                <button type="button" class="bg-gradient-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->