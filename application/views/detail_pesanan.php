
<b>Detail Pesanan : </b><br>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Berat (gram)</th>        
        <th>Qty</th>
        <th>Harga @</th>        
        <th>Subtotal</th>        
        
        
    </tr>
  </thead>
<tbody>

<?php 
  $no = 0;  
  $total=0;
  foreach ($all as $x) {
    $no++;
    $total+=$x->harga_pokok*$x->qty;
    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$x->nama_barang</td>
        <td class='info text-right' width='200px'>$x->berat</td>
        <td class='danger' width='100px'>$x->qty</td>
        <td class='success text-right'>".rupiah($x->harga_pokok)."</td>
        <td class='success text-right'>".rupiah($x->harga_pokok*$x->qty)."</td>             
      </tr>
    ";
  }
?>

  <tr>
    <td colspan="5" align="right"><b>Total</b></td>
    <td align="right"><b><?php echo rupiah($total)?></b></td>
  </tr>

</tbody>
</table>

<div class="col-sm-6"></div>
<div class="col-sm-6">
<div class="text-right">
  <form id="form_pembayaran" enctype="multipart/form-data">
    <input type="hidden" id="total" class="form-control text-right" name="total" value="<?php echo ($total)?>">
    <input type="hidden" name="id_meja" value="<?php echo $id?>">
    <select class="form-control" required="required" name="jenis_pembayaran">
      <option value="">--- pilih pembayaran ---</option>
      <option value="cash">Cash</option>
      <option value="ovo">Ovo</option>
      <option value="transfer_bank">Transfer Bank</option>
      <option value="grab">Grab</option>
      
    </select>
    <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran">
    <button type="submit" class="btn btn-success" id="btn_bayar">Bayar</button>
    <div id="info"></div>
  </form>
</div>
</div>
<script type="text/javascript">

$("#form_pembayaran").on("submit",function(){
   if(confirm("Aksi ini akan mempengaruhi KAS. Anda yakin?"))
   {
    $.ajax({
            url: "<?php echo base_url();?>index.php/meja/simpan_pembayaran",
            type: "POST",
            contentType: false,
            processData:false,
            data:  new FormData(this),
            beforeSend: function(){
                //alert("sedang uploading...");
            },
            success: function(data){
                
              $("#info").html("<div class='alert alert-success'>Berhasil menyimpan! ["+data+"]</div>");
              $("#btn_bayar").hide();
              
              window.open("<?php echo base_url()?>index.php/meja/struk_penjualan/"+data);

            },
            error: function(){

            }           
       });
   }

  return false;
});
</script>