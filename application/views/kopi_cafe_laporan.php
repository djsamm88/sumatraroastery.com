
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
          <h3 class="box-title" id="judul2"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">




<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Kopi</th>                     
              <th align=right>Total Masuk (Gram)</th>                     
              <th align=right>Total Roasting (Gram)</th>                     
              <th align=right>Stok</th>                                               
              
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
                <td align=right>".rupiah($xx->dibeli)."</td>                                
                <td align=right>".rupiah($xx->dijual)."</td>                                
                <td align=right>".rupiah($xx->dibeli-$xx->dijual)."</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>       
  </table>
</div>




          <div class="alert alert-info">
          <form id="go_trx_jurnal">
              <div class="col-sm-5">
                  <input type="text" class="form-control datepicker" name="tgl_awal" id="tgl_awal"  value="<?php echo $tgl_awal ?>" >
              </div>
              <div class="col-sm-5">
                <input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl_akhir"  value="<?php echo $tgl_akhir ?>">
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-primary btn-block" value="Go">
              </div>
          </form>          
          <div style="clear: both"></div>
          </div>








        <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
        

<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Kode Trx</th>                     
                              
              <th>Pembayaran</th>                     
              <th>Tanggal</th>                                               
              <th>Nama</th>                                                                             
              <th>Berat</th>                     
              <th>Total</th>         
              <th>Kategori</th>                          
              <th>Keterangan</th>     
                           

              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total=0;         
        $no = 0;
        foreach($all as $x)
        {
          
          $no++;

 
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>".($x->kode_trx)." </td>
                
                <td>".($x->jenis_pembayaran)."</td>
                <td>$x->tgl_trx</td> 
                <td>$x->nama $x->hp</td> 
                <td align=right>".rupiah($x->berat)."</td>                                
                <td align=right>".rupiah($x->harga)."</td>                                
                <td>".($x->kategori_trx)."</td>
                <td>".($x->keterangan)." </td>
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>       
  </table>
</div>


        </div>

      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<script>
console.log("<?php echo $this->router->fetch_class();?>");
var classnya = "<?php echo $this->router->fetch_class();?>";

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})


$("#go_trx_jurnal").on("submit",function(){
    var tgl_awal   = $("#tgl_awal").val();
    var tgl_akhir  = $("#tgl_akhir").val();
    if( (new Date(tgl_awal).getTime() > new Date(tgl_akhir).getTime()))
    {
      alert("Perhatikan pengisian tanggal. Ada yang salah.");
      return false;
    }

    eksekusi_controller('<?php echo base_url()?>index.php/kopiCafe/laporan_jual_beli/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir,'Laporan Penjualan Pembelian');
  return false;
})



$("#download_pdf").on("click",function(){
  var tgl_awal   = $("#tgl_awal").val();
  var tgl_akhir  = $("#tgl_akhir").val();  
  var url='<?php echo base_url()?>index.php/kopiCafe/laporan_jual_beli_xl/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir;
  window.open(url);

  return false;
})

$(document).ready(function(){

  //$('#tbl_datanya_barang').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
