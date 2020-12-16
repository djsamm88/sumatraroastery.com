
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
          <h3 class="box-title">Trx Penjualan Kopi</h3>

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
    <input type="text" name="nama" id="nama" value="" class="form-control" required placeholder="Nama">
    <small><i>Nama Member</i></small>
  </div>
  <div class="col-sm-6">
    <input type="text" name="hp" id="hp" value="" class="form-control" required placeholder="HP pembeli">
    <small><i>HP Pembeli</i></small>
  </div>
  

</div>
  <div style="clear: both;"></div>
  <br>


<table class="table table-bordered table-striped" id="tbl_trx">
  <thead>
    <tr>
        <th>No</th>
        <th>Kopi</th>
        <th>Harga Member</th>
        <th width="200px">Berat (gram)</th>        
        <th width="200px">qty </th>        
        
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
        <td class='warning'>$kopi->nama_barang</td>
        <td class='success text-right' id='harga'>".rupiah($kopi->harga_member)."</td>        
        <td class='success text-right' id='berat'>".rupiah($kopi->berat)."</td>        
        <td class='danger' width='100px'>
          <input type='text' name='qty[]' class='form-control nomor' placeholder='Jumlah' required value='0' id='qty'>
          <input type='hidden'  value='$kopi->id' id='id' name='id_barang[]'>
          <input type='hidden'  value='$kopi->harga_member'  name='harga_agen[]'>
          <input type='hidden'  value='$kopi->berat'  name='berat[]'>
          
        </td>
        
      </tr>
    ";
  }
?>
</tbody>
<tfoot>
  <tr>
    <td colspan="2" class="text-right">Total:</td>
    <td id="total" class="text-right">0</td>
    <td id="total_berat" class="text-right">0</td>
    <td id="total_qty" class="text-right">0</td>
  </tr>
</tfoot>
</table>




            <div class="col-sm-4" style="text-align:right">Diskon</div>
            <div class="col-sm-8">
              <input type="text" class="form-control nomor" name="diskon" id="diskon">
            </div> 
            <div style="clear:both"></div><br>

            
          
          <div class="col-sm-4" style="text-align:right"> Pembayaran</div>
            <div class="col-sm-8">
            <select class="form-control" required="required" name="jenis_pembayaran">
              <option value="">--- pilih pembayaran ---</option>
              <option value="cash">Cash</option>
              <option value="transfer_bank">Transfer BNI</option>
              <option value="edc">EDC BNI</option>
              <option value="ovo">OVO</option>
              
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


$("#tbl_trx tbody tr td #qty").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
  total();
})

function total()
{
  var total=0;
  var total_qty=0;
  var total_berat=0;
  $("#tbl_trx tbody tr").each(function(){
     var harga=0;
     var berat=0;
     var qty=0;  
     var subtotal=0;
     var subtotal_berat=0;
     harga= parseInt(buang_titik($(this).find("td#harga").text())) || 0;
     berat= parseInt(buang_titik($(this).find("td#berat").text())) || 0;
     qty= parseInt(buang_titik($(this).find("td #qty").val())) || 0;
     subtotal=qty*harga;
     total+=subtotal;
     total_qty+=qty;
     total_berat+=(qty*berat);

  })
  console.log(total_berat);
  $("#tbl_trx tfoot tr td#total").html(formatRupiah(total));
  $("#tbl_trx tfoot tr td#total_qty").html(formatRupiah(total_qty));
  $("#tbl_trx tfoot tr td#total_berat").html(formatRupiah(total_berat));

  if(total>50000000)
  {
    $("#simpan").hide();
    alert("Agen tidak bisa lebih besar dari 50jt ");

  }else{
    $("#simpan").show();
  }
}

hanya_nomor(".nomor");
function buang_titik(mystring)
{
  return (mystring.replace(/\./g,''));
}

function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


  $("#penjualan_barang").on("submit",function(){
    if(confirm("Anda yakin? Pastikan tidak ada kesalahan."))
    {
      
      var ser = $(this).serialize();
      $.ajax({
              url: "<?php echo base_url()?>index.php/meja/simpan_kasir_member",
              type: "POST",
              contentType: false,
              processData:false,
              data:  new FormData(this),
              beforeSend: function(){
                  //alert("sedang uploading...");
              },
              success: function(data){
                $("#t4_info_form").html("<div class='alert alert-success'>Berhasil..["+data+"]</div>").fadeIn().delay(10000).fadeOut();
                  
                
                //$("#simpan").hide();
                

                //bayar
                //window.open("<?php echo base_url()?>index.php/gudang/struk_kasir_gudang/"+data);
                //window.open("<?php echo base_url()?>index.php/meja/struk_kopi/"+data);
                window.open("<?php echo base_url()?>index.php/meja/struk_kopi/"+data);

              },
              error: function(){

              }           
         });
    }
    return false;
  })
</script>