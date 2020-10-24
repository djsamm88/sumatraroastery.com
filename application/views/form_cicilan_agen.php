
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi 
        <small>UMROH</small>
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content container-fluid" >

      <!--------------------------
        | Your Page Content Here |
        -------------------------->    
<!-- Default box -->
   
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" id="judul2">Form Cicilan Agen</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
             
             <div id="div_form">
             <form id="form_penambahan_kas">            
            <div style="clear: both;"></div><br>
            <div class="col-sm-3">Jumlah</div>
            <div class="col-sm-9">
                <input type="text" name="jumlah" class="form-control nomor" required="required">
            </div>
            <div style="clear: both;"></div><br>

            <div class="col-sm-3">Atas Nama</div>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" required="required">
            </div>
            <div style="clear:both"></div><br>
            <div class="col-sm-3">Keterangan</div>
            <div class="col-sm-9">
                <input type="text" name="keterangan" class="form-control" required="required">
            </div>

            <div style="clear:both"></div><br>

            <div class="col-sm-3">Bukti Pembayaran</div>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran">
            </div> 
            <div style="clear:both"></div><br>


            <div style="clear: both;"></div><br>
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <input type="submit"  class="btn btn-success" value="Simpan" id="simpan">
            </div>
            <div style="clear: both;"></div><br>
            </form>
            </div>

            <div id="t4_info_form"></div>
        </div>
      </div>

</section>
    <!-- /.content -->

<script type="text/javascript">
  hanya_nomor(".nomor");
 


  $("#form_penambahan_kas").on("submit",function(){
    if(confirm("Anda yakin? Pastikan tidak ada kesalahan."))
    {
      
      var ser = $(this).serialize();
      $.ajax({
              url: "<?php echo base_url()?>index.php/meja/simpan_cicilan_agen",
              type: "POST",
              contentType: false,
              processData:false,
              data:  new FormData(this),
              beforeSend: function(){
                  //alert("sedang uploading...");
              },
              success: function(data){
                $("#t4_info_form").html("<div class='alert alert-success'>Berhasil..["+data+"]</div>").fadeIn().delay(3000).fadeOut();
                  
                
                $("#simpan").hide();
                

                //bayar
                //window.open("<?php echo base_url()?>index.php/gudang/struk/"+data);
                

              },
              error: function(){

              }           
         });
    }
    return false;
  })


  $("html, body").animate({ scrollTop: 0 }, "slow");
</script>