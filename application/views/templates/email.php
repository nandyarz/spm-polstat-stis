<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
                    <?php echo form_open_multipart('Email/sendMail'); ?>
                    <!-- <form id="RegisterValidation" action="" method=""> -->
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Kirim Email</h4>

                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="email">Tambahkan Pesan *</label>
                                <?= form_input(['type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Tuliskan pesan di sini']); ?>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="subject">Subject *</label>
                                <?= form_input(['name' => 'subject', 'id' => 'subject', 'class' => 'form-control', 'placeholder' => 'Tuliskan pesan di sini']); ?>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="pesan">Tambahkan Pesan *</label>
                                <?= form_input(['type' => 'text', 'name' => 'pesan', 'id' => 'pesan', 'class' => 'form-control', 'placeholder' => 'Tuliskan pesan di sini']); ?>
                            </div> 
                        </div>
                    
                        <div class="category form-category">
                            <div class="form-footer text-right">
                                <button type="submit" class="btn btn-success btn-fill">Kirim</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

<!-- <!DOCTYPE html>
<html>
    <head>
        <title>CodeIgniter Send Email</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <h3>Use the form below to send email</h3>
            <form method="post" action="<?=base_url('email')?>" enctype="multipart/form-data">
                <input type="email" id="to" name="to" placeholder="Receiver Email">
                <br><br>
                <input type="text" id="subject" name="subject" placeholder="Subject">
                <br><br>
                <textarea rows="6" id="message" name="message" placeholder="Type your message here"></textarea>
                <br><br>
                <input type="submit" value="Send Email" />
            </form>
        </div>
    </body>
</html> -->