<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php echo form_open_multipart(); ?>
                    <!-- <form id="RegisterValidation" action="" method=""> -->
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment_ind</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Edit Unit</h4>

                        <div class="form-group">
                            <label class="label-control">ID Unit</label>
                            <input class="form-control" name="id_unit" id="id_unit" type="text" value="<?= $unit['id_unit']; ?>" />
                        </div>
                        <?= form_error('id_unit', '<div class="text-danger">', '</div>'); ?>

                        <div class="form-group">
                            <label class="label-control">Nama</label>
                            <input class="form-control" name="nama" id="nama" type="text" value="<?= $unit['nama']; ?>" />
                        </div>
                        <?= form_error('nama', '<div class="text-danger">', '</div>'); ?>


                        <div class="form-group">
                            <label class="label-control">Email</label>
                            <input type = "email" class="form-control" name="email" id="email" type="text" value="<?= $unit['email']; ?>" />
                        </div>
                        <?= form_error('email', '<div class="text-danger">', '</div>'); ?>
                        
                        <div class="category form-category">
                            <div class="form-footer text-right">

                                <button type="submit" class="btn btn-success btn-fill">simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>