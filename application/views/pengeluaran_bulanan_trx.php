
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

              
<table id="tbl_datanyax" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Tanggal</th>                     
              <th>Pengeluaran</th>                                                 
              <th>Jenis</th>                                                 
              <th>Keterangan</th>                                                 
              <th>Bukti</th>                                                 
              <th>Jumlah</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>".tglindo($x->tgl_update)."</td>
                <td>$x->nama_pengeluaran</td>                                
                <td>$x->jenis</td>                                
                <td>$x->keterangan</td>          
                <td><a href='".base_url()."uploads/$x->bukti_pembayaran' target='blank'>$x->bukti_pembayaran</td>                                  
                <td style='text-align:right'>".rupiah($x->jumlah)."</td>                                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


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

    eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/trx_pengeluaran_bulanan/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir,'Laporan Pengeluaran');
  return false;
})




$(document).ready(function(){

  $('#tbl_datanyax').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
