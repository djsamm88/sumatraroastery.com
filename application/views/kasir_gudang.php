
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        
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
          <h3 class="box-title">Trx</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body ">
              


<form id="penjualan_barang">
  <div class="row">
  
  <div class="col-sm-6">
    <input type="text" name="nama_pembeli" id="nama_pembeli" value="" class="form-control" required placeholder="Nama pembeli">
    <input type="hidden" name="nama" id="nama" value="">
    <small><i>Nama Pembeli</i></small>
  </div>
  <div class="col-sm-6">
    <input type="text" name="hp" id="hp" value="" class="form-control" required placeholder="HP pembeli">
    <small><i>HP Pembeli</i></small>
  </div>
  

</div>
  <div style="clear: both;"></div>
  <br>


<table class="table table-bordered table-striped">
  <thead>
    <tr>
        <th>No</th>
        <th>Kopi</th>
        <th>Harga</th>
        <th width="200px">Berat (gram)</th>        
        
    </tr>
  </thead>
<tbody>

<?php 
  $no = 0;  
  foreach ($data_kopi as $kopi) {
    $no++;

    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$kopi->nama_kopi</td>
        <td class='success text-right'>".rupiah($kopi->harga_jual)."</td>        
        <td class='danger' width='100px'>
          <input type='number' name='berat[]' class='form-control' placeholder='Jumlah' value='0' id='berat'>
          <input type='hidden'  value='$kopi->id' id='id' name='id_kopi[]'>
          <input type='hidden'  value='$kopi->harga_jual' id='harga_jual' name='harga_jual[]'>
          
        </td>
        
      </tr>
    ";
  }
?>


</tbody>
</table>
          
          <div class="col-sm-4" style="text-align:right"> Pembayaran</div>
            <div class="col-sm-8">
            <select class="form-control" required="required" name="jenis_pembayaran">
              <option value="">--- pilih pembayaran ---</option>
              <option value="cash">Cash</option>
              <option value="utang">Utang</option>
              
            </select>
          </div>
          <br>
          <br>



            <div class="col-sm-4" style="text-align:right">Bukti Pembayaran</div>
            <div class="col-sm-8">
              <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran">
            </div> 
            <div style="clear:both"></div><br>

            
            <div class="col-sm-4" style="text-align:right">Keterangan </div>
            <div class="col-sm-8">
              <textarea type="text" class="form-control" name="keterangan" id="keterangan" required></textarea>
            </div> 
            <div style="clear:both"></div><br>
            
            <div class="col-sm-12">
                <div id="t4_info_form"></div>
                <input type="submit" value="Simpan" class="btn btn-primary" id="simpan">  
            </div>
          </form>



      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<script type="text/javascript">
  
  $("#penjualan_barang").on("submit",function(){
    if(confirm("Anda yakin? Pastikan tidak ada kesalahan."))
    {
      
      var ser = $(this).serialize();
      $.ajax({
              url: "<?php echo base_url()?>index.php/gudang/simpan_kasir",
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
                //window.open("<?php echo base_url()?>index.php/gudang/struk_kasir_gudang/"+data);

              },
              error: function(){

              }           
         });
    }
    return false;
  })
</script>