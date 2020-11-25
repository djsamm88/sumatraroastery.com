
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
              <th>Ekspedisi</th>                     
              <th>Sub Total</th>                     
              <th>Struk</th>                     
              <th>Bukti Bayar</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total=0;         
        $no = 0;
        $eks = 0;
        foreach($all as $x)
        {
          $total += $x->total;
          $eks += $x->harga_ekspedisi;
          $no++;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>".($x->nama_admin)." </td>
                <td>".($x->tgl_trx)."</td>
                <td>$x->group_trx</td>            
                <td align=right>".rupiah($x->harga_ekspedisi)."</td>                                
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
                <th style='text-align:right'><b>Rp.<?php echo rupiah($eks)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></th>
             </tr>
           </tfoot>
  </table>
</div>



Menu:
<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Id Barang</th>                     
              <th>Nama Barang</th>                                               
              <th>Terjual</th>                                                                             
              <th>Harga @</th>                     
              <th>SubTotal</th>                     
              
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        
        $non = 0;
        $tot_menu = 0;
        foreach($menu as $xxxx)
        {
          
          $non++;
          $tot_menu+=$xxxx->total;
            
            echo (" 
              
              <tr>
                <td>$non</td>                
                <td>".($xxxx->id_barang)." </td>                
                <td>".($xxxx->nama_barang)." </td>                
                <td>".rupiah($xxxx->qty)." </td>                
                <td>".rupiah($xxxx->harga_pokok)." </td>                
                <td align=right>".rupiah($xxxx->total)."</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       <tfoot>
             <tr>
                <th colspan='5' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_menu)?></b></th>
             </tr>
           </tfoot>
  </table>
</div>







Bubuk kopi:
<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Id Barang</th>                     
              <th>Nama Barang</th>                                               
              <th>Terjual</th>                                                                             
              <th>Harga @</th>                     
              <th>SubTotal</th>                     
              
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        
        $non = 0;
        $tot_kopi = 0;
        foreach($kopi as $yyy)
        {
          
          $non++;
          $tot_kopi+=$yyy->total;
            
            echo (" 
              
              <tr>
                <td>$non</td>                
                <td>".($yyy->id_barang)." </td>                
                <td>".($yyy->nama_barang)." </td>                
                <td>".rupiah($yyy->qty)." </td>                
                <td>".rupiah($yyy->harga_pokok)." </td>                
                <td align=right>".rupiah($yyy->total)."</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       <tfoot>
             <tr>
                <th colspan='5' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_kopi)?></b></th>
             </tr>
           </tfoot>
  </table>
</div>





Barang Titipan:
<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Id Barang</th>                     
              <th>Nama Barang</th>                                               
              <th>Terjual</th>                                                                             
              <th>Harga @</th>                     
              <th>SubTotal</th>                     
              
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        
        $non = 0;
        $tot_titipan = 0;
        foreach($titipan as $xx)
        {
          
          $non++;
          $tot_titipan+=$xx->total;
            
            echo (" 
              
              <tr>
                <td>$non</td>                
                <td>".($xx->id_barang)." </td>                
                <td>".($xx->nama_barang)." </td>                
                <td>".rupiah($xx->qty)." </td>                
                <td>".rupiah($xx->harga_pokok)." </td>                
                <td align=right>".rupiah($xx->total)."</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       <tfoot>
             <tr>
                <th colspan='5' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_titipan)?></b></th>
             </tr>
           </tfoot>
  </table>
</div>




Jasa Roasting:
<div class="table-responsive">              
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Id Barang</th>                     
              <th>Nama Barang</th>                                               
              <th>Qty</th>                                                                             
              <th>Berat</th>                                                                             
              <th>Harga @</th>                     
              <th>Sub Total</th>                     
              
              
              
        </tr>
      </thead>
      <tbody>
        <?php
        
        $non = 0;
        $tot_roasting = 0;
        foreach($roasting as $xxx)
        {
          
          $non++;
          $tot_roasting+=$xxx->total;
            
            echo (" 
              
              <tr>
                <td>$non</td>                
                <td>".($xxx->id_barang)." </td>                
                <td>".($xxx->nama_barang)." </td>                
                <td>".rupiah($xxx->qty)." </td>                
                <td>".rupiah($xxx->berat)." </td>                
                <td>".rupiah($xxx->harga_pokok)." </td>                
                <td align=right>".rupiah($xxx->total)."</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
       <tfoot>
             <tr>
                <th colspan='6' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_roasting)?></b></th>
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
