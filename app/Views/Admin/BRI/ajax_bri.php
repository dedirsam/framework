<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.css">

<!-- Script untuk memicu modal edit -->
<script>
    var saldoBRI = document.getElementById('saldo-bri');
    saldoBRI.addEventListener('click', function() {
        $('#editModal').modal('show');
    });
</script>

<script>
    $(function() {
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

    function rubah() {
        save_method = 'rubah';
        $('#rubah')[0].reset(); // reset form on modals
        $('#editModal').modal('show'); // show bootstrap modal
    }

    function tambah_saldo() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form_saldo').modal('show'); // show bootstrap modal
    }

    function save() {
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('Admin/BRI/isi') ?>";
        } else {
            url = "<?php echo site_url('Admin/BRI/rubah') ?>";
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

    function rubahData(id) {
        save_method = 'rubah';
        $('#editModal')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        // $('#editModal').modal('show'); // Menampilkan modal
        // Menyiapkan URL untuk permintaan AJAX
        // var url = "<?php echo site_url('Admin/BRI/rubah/') ?>" + id;
        // AJAX untuk mengirimkan data ke backend
        $.ajax({
            // url: url,
            var url = "<?php echo site_url('Admin/BRI/rubah/') ?>" + id;
            type: "POST",
            // data: $('#rubah').serialize(),
            dataType: "JSON",
            success: function(response) {
                if (response.status == true) {
                    // Jika berhasil, tampilkan Sweet Alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Jika pengguna menekan tombol "OK", tutup modal dan muat ulang halaman
                        if (result.isConfirmed) {
                            $('#editModal').modal('hide');
                            location.reload();
                        }
                    });
                } else {
                    // Jika gagal, tampilkan Sweet Alert dengan pesan dari server
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error updating data');
            }
        });
    }
</script>