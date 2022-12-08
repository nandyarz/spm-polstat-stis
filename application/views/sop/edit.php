<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php echo form_open_multipart(); ?>
                    <!-- <form id="RegisterValidation" action="" method=""> -->
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Edit SOP</h4>

                        <div class="form-group">
                            <label class="label-control">Nama SOP</label>
                            <input class="form-control" name="nama_sop" id="nama_sop" type="text" value="<?= $sop['nama_sop']; ?>" required="true" />
                        </div>

                        <div class="form-group">
                            <label class="label-control">Tempat SOP</label>
                            <input type="text" class="form-control datepicker" name="tempat_sop" id="tempat_sop" value="<?= $sop['tempat_sop']; ?>" />
                        </div>

                        <div class="form-group">
                            <label class="label-control">Tanggal SOP</label>
                            <input type="date" class="form-control datepicker" name="tanggal_sop" id="tanggal_sop" value="<?= $sop['tanggal_sop']; ?>" />
                        </div>

                        <div class="form-group">
                            <label class="label-control">Unit SOP</label>
                            <input class="form-control" name="unit_sop" id="unit_sop" value="<?= $sop['unit_sop']; ?>" type="text" required="true" />
                        </div>

                        <div class="form-group">
                            <label class="label-control">File Surat</label>



                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <!-- <img src="<?= base_url('./uploads/sop/') ?>" alt="..."> -->
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                    <span class="btn btn-danger btn-file">
                                        <i class="material-icons">cloud_upload</i>
                                        <span class="fileinput-new">Select File</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="file_surat" id="file_surat" />
                                    </span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>
                        </div>

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