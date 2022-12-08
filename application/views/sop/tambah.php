<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
                    <?php echo form_open_multipart('sop/ajukan', 'id="ajukan"'); ?>
                    <!-- <form id="RegisterValidation" action="" method=""> -->
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Tambah SOP</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="nama_sop">Nama Kegiatan *</label>
                                <?= form_input(['name' => 'nama_sop', 'id' => 'nama_sop', 'class' => 'form-control', "required" => "required", 'placeholder' => '']); ?>
                            </div>
                            <div class="col-lg-6">
                                <label for="tempat_sop">Tempat Kegiatan *</label>
                                <?= form_input(['name' => 'tempat_sop', 'id' => 'tempat_sop', 'class' => 'form-control', "required" => "required", 'placeholder' => '']); ?>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="tanggal_sop">Tanggal Kegiatan *</label>
                                <?= form_input(['type' => 'date', 'name' => 'tanggal_sop', 'id' => 'tanggal_sop', 'class' => 'form-control', "required" => "required", 'placeholder' => '']); ?>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="unit_sop">Unit *</label>
                                <?= form_dropdown('unit_sop', $unit_sop, '', ['id' => 'unit_sop', 'class' => 'form-control']); ?>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <label class="label-control">File SOP</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <!-- <img src="<?= base_url() ?>assets/save.png" alt="..."> -->
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-danger btn-file">
                                            <i class="material-icons">cloud_upload</i>
                                            <span class="fileinput-new">Select File</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="file" id="file" />
                                            <?= form_upload(['name' => 'file', 'id' => 'file', 'class' => 'form-control']) ?>
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                    
                        <small>
                            <p class="text-danger">PENTING!! Syarat Harus Terpenuhi. Jika Tidak, SOP Tidak Diproses!</p>
                            </div>
                        </small>
                        <div class="category form-category">
                            <div class="form-footer text-right">

                                <button type="submit" class="btn btn-success btn-fill">simpan</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>

            </div>
        </div>
    </div>