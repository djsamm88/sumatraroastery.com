
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di POS
        <small></small>
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
          <h3 class="box-title" id="judul2">Tambah Stok Bubuk</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">





<form id="form_stok">

<div class="table-responsive">   
<table class="table table-bordered table-striped" id="tbl_stok">
  <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>        
        <th>Berat (gram)</th>
        <th>Stok</th>        
        <th>Qty</th>        
        

        
    </tr>
  </thead>
<tbody>

<?php 
  $no = 0;  
  foreach ($stok_bubuk as $kopi) {
    $no++;

    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$kopi->nama_barang</td>        
        <td class='info text-right' width='200px'>$kopi->berat</td>
        <td class='info text-right' width='200px'>$kopi->stok</td>
        <td class='danger' width='100px'>
          <input type='text' name='qty[]' class='form-control nomor' placeholder='Jumlah' value='0' id='qty'>
          <input type='hidden'  value='$kopi->id' id='id' name='id[]'>          
          <input type='hidden'  value='$kopi->berat' id='berat' name='berat[]'>
        </td>
                
      </tr>
    ";
  }
?>


</tbody>
</table>
</div>


            


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

      </div>
      <!-- /.box -->

</section>
<!-- /.content -->

<script type="text/javascript">

$(document).ready(function(){

  $('#tbl_stok').dataTable();

});

hanya_nomor(".nomor");
  
$("#form_stok").on("submit",function(){
    if(confirm("Anda yakin? Pastikan tidak ada kesalahan."))
    {
      
      var ser = $(this).serialize();
      $.ajax({
              url: "<?php echo base_url()?>index.php/kopiCafe/simpan_stok_masuk",
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
</script>
