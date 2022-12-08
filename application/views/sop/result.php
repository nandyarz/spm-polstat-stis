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
                        <div class="text-justify pl-5 pr-5">
							<div class="row justify-content-center">
								<div class="col-12 col-md-10 col-lg-10">
									<div class="row">
										<div class="col-lg-7">
											<h3>Keterangan:</h3>
											<table class="table">
												<tr>
													<td>ID SOP</td>
													<td>:</td>
													<td><?= $row['id'] ?></td>
												</tr>
												<tr>
													<td>Nama Kegiatan</td>
													<td>:</td>
													<td><?= $row['nama_sop'] ?></td>
												</tr>
												<tr>
													<td>Tempat Kegiatan</td>
													<td>:</td>
													<td><?= $row['tempat_sop'] ?></td>
												</tr>
												<tr>
													<td>Tanggal Kegiatan</td>
													<td>:</td>
													<td><?= $row['tanggal_sop'] ?></td>
												</tr>
												<tr>
													<td>Unit</td>
													<td>:</td>
													<td><?= $options[$row['unit_sop']] ?></td>
												</tr>
												<tr>
													<td>SOP</td>
													<td>:</td>
													<td>
														<button class="btn btn-outline-info" data-toggle="modal" data-target="#lihatFile<?= $row['id']; ?>"><i class="fa fa-eye"></i></button>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<div>
										<div class="checkout-wrap">
											<ul class="checkout-bar">
												<?php if ($row['status'] == '1') : ?>
													<li class="active first">Pengajuan SOP<br>di unggah</li>
													<li class="">SOP<br>Diterima</li>
													<li class="">Validasi SOP<br>Dilanjutkan</li>
													<li class="">Menunggu<br>divalidasi</li>
													<li class="">Sudah divalidasi<br>&nbsp;</li>
													<li class="">Selesai<br>&nbsp;</li>
												<?php elseif ($row['status'] == '2') : ?>

													<li class="active first">Pengajuan SOP<br>di unggah</li>
													<li class="">SOP<br>Ditolak</li>
													<h1>MAAF SOP ANDA DITOLAK KARENA SYARAT TIDAK TERPENUHI</h1>


												<?php elseif ($row['status'] == 3) : ?>
													<li class="active first">Pengajuan SOP<br>di unggah</li>
													<li class="active">SOP<br>Diterima</li>
													<li class="active">Validasi SOP<br>Dilanjutkan</li>
													<li class="">Menunggu<br>divalidasi</li>
													<li class="">Sudah divalidasi<br>&nbsp;</li>
													<li class="">Selesai<br>&nbsp;</li>
												<?php elseif ($row['status'] == '4') : ?>
													<li class="active first">Pengajuan SOP<br>di unggah</li>
													<li class="active">SOP<br>Diterima</li>
													<li class="active">Validasi SOP<br>Dilanjutkan</li>
													<li class="active">Menunggu<br>divalidasi</li>
													<li class="">Sudah divalidasi<br>&nbsp;</li>
													<li class="">Selesai<br>&nbsp;</li>
												<?php elseif ($row['status'] == '5') : ?>
													<li class="active first">Pengajuan SOP<br>di unggah</li>
													<li class="active">SOP<br>Diterima</li>
													<li class="active">Validasi SOP<br>Dilanjutkan</li>
													<li class="active">Menunggu<br>divalidasi</li>
													<li class="active">Sudah divalidasi<br>&nbsp;</li>
													<li class="active">Selesai<br>&nbsp;</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
						</div>
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