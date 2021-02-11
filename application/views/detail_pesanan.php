
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
        <th width="100"></th>        
        
        
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
        <td class='success text-right'><button class='btn btn-xs btn-danger' onclick='batal_order($x->id_barang, $(this))'>Batal</button></td>             
      </tr>
    ";
  }
?>

  <tr>
    <td colspan="5" align="right"><b>Total</b></td>
    <td align="right"><b id="total_atas"><?php echo rupiah($total)?></b></td>
  </tr>

</tbody>
</table>

<div class="col-sm-6"></div>
<div class="col-sm-6">
<div class="text-right">
  <form id="form_pembayaran" enctype="multipart/form-data" form autocomplete="off">
    <input type="hidden" id="total" class="form-control text-right" name="total" value="<?php echo ($total)?>">
    <input type="hidden" name="id_meja" value="<?php echo $id?>">
    
    <input type="text" id="harga_ekspedisi" class="form-control text-right nomor" name="harga_ekspedisi" value="" placeholder="Ekspedisi">

    <input type="text" id="diskon_bubuk" class="form-control text-right nomor" name="diskon_bubuk" value="" placeholder="Diskon Bubuk">


    <input type="text" id="diskon_cafe" class="form-control text-right nomor" name="diskon_cafe" value="" placeholder="Diskon Cafe">




    <br>

    <input type="text" id="total_all" class="form-control text-right" value="<?php echo rupiah($total)?>" placeholder="Total" readonly="">

    <br>
    <input type="text" id="bayar" class="form-control text-right nomor" placeholder="Bayar" >
    <br>
    <input type="text" id="kembali" class="form-control text-right " placeholder="Kembali" readonly="">

    <br>



    <select class="form-control" required="required" name="jenis_pembayaran">
      <option value="">--- pilih pembayaran ---</option>
      <option value="cash">Cash</option>
      <option value="ovo">Ovo/BCA</option>
      <option value="transfer_bank">Transfer BNI</option>
      <option value="edc">EDC BNI</option>
      
    </select>
    <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran">

    <br>
    <button type="submit" class="btn btn-success" id="btn_bayar">Bayar</button> 
    <div id="info"></div>
  </form>
</div>
</div>
<script type="text/javascript">

function batal_order(id,ini)
{
  if(confirm("Anda yakin menghapus item ini?"))
  {
    $("#t4_buku_menu").empty();
    $.get("<?php echo base_url()?>index.php/meja/batal_order/"+id,function(){
      $("#myModal").modal('hide');
    })
    
  }

}

$("#diskon_cafe,#harga_ekspedisi,#diskon_bubuk").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
   total();
   kembalian();
})

$("#bayar").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
   kembalian();
})


function kembalian()
{
  var total_all = parseInt(buang_titik($("#total_all").val()))||0;
  var bayar = parseInt(buang_titik($("#bayar").val()))||0;
  var kemb = bayar - total_all;
  $("#kembali").val(formatRupiah(kemb));
  console.log(kemb)

}

function total()
{   
    var total = 0;
    var tot = parseInt(buang_titik($("#total_atas").text()))||0;
    var harga_ekspedisi = parseInt(buang_titik($("#harga_ekspedisi").val()))||0;
    var diskon_cafe = parseInt(buang_titik($("#diskon_cafe").val()))||0;
    var diskon_bubuk = parseInt(buang_titik($("#diskon_bubuk").val()))||0;
    var diskon = (diskon_bubuk + diskon_cafe);
     total += tot;
     total += harga_ekspedisi;
     total -= diskon;
    $("#total_all").val(formatRupiah(total));
    console.log(total);

}


function buang_titik(mystring)
{
  try{
    return mystring.replace(/\./g,'');
  }catch{
    return 0;
  }
  
}

function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

hanya_nomor(".nomor");
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