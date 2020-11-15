
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
          <h3 class="box-title">Trx Roasting Kopi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body ">
              


<form id="form_rasting">
  <div class="row">
  
  <div class="col-sm-6">
    <input type="text" name="nama" id="nama" value="Sumatera Cafe" class="form-control" required readonly="">
    
    <small><i>Nama Pembeli</i></small>
  </div>
  <div class="col-sm-6">
    <input type="text" name="hp" id="hp" value="xxx" class="form-control" required readonly ="">
    <small><i>HP Pembeli</i></small>
  </div>
  

</div>
  <div style="clear: both;"></div>
  <br>


        <div class="table-responsive">              
        <table id="tbl_roasting" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
              <thead>
                <tr>
                      
                      <th>No</th>                    
                      <th>Nama Kopi</th>                                           
                      <th align=right>Stok (Gram)</th>                                               
                      <th align="right" width="200">Roasting (Gram) <br><small>Yg mau di roasting</small></th>                                               
                      
                </tr>
              </thead>
              <tbody>
                <?php
                $total=0;         
                $no = 0;
                foreach($stok as $xx)
                {
                  
                  $no++;

         
                    echo (" 
                      
                      <tr class='success'>
                        <td>$no</td>                                
                        <td>".($xx->nama_kopi)."</td>                                                        
                        <td align='right' id='stok_lama'>
                         <input type='hidden'  value='".($xx->dibeli-$xx->dijual)."' id='stok_lama'>
                            ".rupiah($xx->dibeli-$xx->dijual)."</td>                                
                        <td>
                          <input type='text' name='berat[]' class='form-control nomor' required placeholder='Jumlah' value='0' id='berat'>
                          <input type='hidden'  value='$xx->id' id='id' name='id_kopi[]'>                          
                        </td>
                      </tr>
                  ");
                  
                }
                
                
                ?>
              </tbody>       
              <tfoot>
              <tr>
                <td colspan="3">Total:</td>                
                <td id="total_berat" class="text-right">0</td>
              </tr>
            </tfoot>
          </table>
        </div>



            
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

$("#tbl_roasting tbody tr td #berat").on("keydown keyup mousedown mouseup select contextmenu drop",function(){
  total();
})

function total()
{  
  var total_berat=0;
  $("#tbl_roasting tbody tr").each(function(){     
     var berat=0;  
     var subtotal=0;

     var stok_lama = parseInt(buang_titik($(this).find("td #stok_lama").val())) || 0;     
     berat= parseInt(buang_titik($(this).find("td #berat").val())) || 0;     
     

     if(berat>stok_lama)
     {
      alert("Tidak bisa lebih besar dari stok..!!"+ " - " + berat +">"+ stok_lama);
      $(this).find("td #berat").val(stok_lama);
      berat=stok_lama;
     }


      total_berat+=berat;

  })
  console.log(total_berat);
  $("#tbl_roasting tfoot tr td#total_berat").html(formatRupiah(total_berat));
  

}


hanya_nomor(".nomor");
function buang_titik(mystring)
{
  return (mystring.replace(/\./g,''));
}

function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

  
  $("#form_rasting").on("submit",function(){
    if(confirm("Anda yakin? Pastikan tidak ada kesalahan."))
    {
      
      var ser = $(this).serialize();
      $.ajax({
              url: "<?php echo base_url()?>index.php/kopiCafe/simpan_kasir_roasting",
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