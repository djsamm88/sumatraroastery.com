
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

<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Kasir</th>                     
              <th>Tanggal</th>                                               
              <th>Kode Trx.</th>                                                                             
              <th>Sub Total</th>                     
              <th>Struk</th>                     
              <th>Bukti Bayar</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total=0;         
        $no = 0;
        foreach($all as $x)
        {
          $total += $x->total;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>".($x->nama_admin)." </td>
                <td>".($x->tgl_trx)."</td>
                <td>$x->group_trx</td>                                
                <td align=right>".rupiah($x->total)."</td>                                
                <td><a href='".base_url()."index.php/meja/struk_penjualan/".$x->group_trx."' target='blank'>Print</a></td>  
                <td><a href='".base_url()."uploads/".$x->url_bukti."' target='blank'>Bukti</a></td>                                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       <tfoot>
             <tr>
                <th colspan='4' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></th>
             </tr>
           </tfoot>
  </table>
</div>


        </div>

 <?php
    if ($this->session->userdata('level') == '1') {

    ?>
        <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
        <?php } ?>
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

    eksekusi_controller('<?php echo base_url()?>index.php/meja/penjualan/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir,'Laporan Penjualan');
  return false;
})



$("#download_pdf").on("click",function(){
  
  var ser = $("#go_trx_jurnal").serialize();
  var url="<?php echo base_url()?>index.php/meja/penjualan_xl/?"+ser;
  window.open(url);

  return false;
})

$(document).ready(function(){

  //$('#tbl_datanya_barang').dataTable();

});
$("#judul2").html("DataTable "+document.title);
</script>
