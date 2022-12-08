<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="orange">
                        <i class="material-icons">mail</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">SOP</h4>
                        
                            <?php if ($this->session->flashdata('success') == TRUE) : ?>
                                <div class="alert alert-success">
                                    <span><?= $this->session->flashdata('success'); ?></span>
                                </div>
                            <?php endif; ?>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama SOP</th>
                                        <th>Unit</th>
                                        <th>Tanggal Selesai</th>
                                        <th>File</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1; ?>
                                    <?php foreach ($data as $key) : ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $key['id']; ?></td>
                                            <td><?= $key['nama_sop']; ?></td>
                                            <td><?= $key['unit_sop']; ?></td>
                                            <td><?= $key['tanggal_selesai']; ?></td>
                                            <td><?= $key['file']; ?></td>
                                            <td>
                                                <!-- <a href="#" class="btn btn-simple btn-info btn-icon like"><i class="material-icons">remove_red_eye</i></a> -->
                                                <!-- <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>
                                                <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a> -->
                                                <button class="btn btn-simple btn-info" data-toggle="modal" data-target="#lihatSurat<?= $key['id']; ?>"><i class="material-icons">remove_red_eye</i></button>
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-simple btn-warning btn-icon" data-toggle="modal" data-target="#hapusSopSelesai<?= $key['id']; ?>"><i class="material-icons">close</i></button>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>


                        <!-- small modal hapus user -->

                        <?php foreach ($data as $key) : ?>
                            <div class="modal fade" id="hapusSopSelesai<?= $key['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-small ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                        </div>

                                        <form method="post" action="<?= base_url(); ?>sop/hapusSopSelesai/<?= $key['id']; ?>">
                                            <div class="modal-body text-center">
                                                <h5>Apakah anda yakin untuk menghapus SOP? </h5>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button type="button" class="btn btn-simple" data-dismiss="modal">Tidak</button>
                                                <button type="submit" class="btn btn-success btn-simple">Ya</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!--    end small modal hapus user -->

                        <!-- notice modal -->

                        <?php foreach ($data as $key) : ?>
                            <div class="modal fade" id="lihatSurat<?= $key['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-notice">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                            <h5 class="modal-title text-center" id="myModalLabel">SOP</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="instruction">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <embed type="application/pdf" width="100%" height="450px;" src="<?= base_url('uploads/berkas') ?>/<?= $key['file'] ?>"></embed>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- end notice modal -->


                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>