
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        Selamat datang di Sistem Informasi 
        
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
          <h3 class="box-title" id="judul2">Transaksi Harian</h3>

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
<h3>Sumatera Bubuk Kopi</h3>
<table class="table table-bordered" id="tbl_jurnal">
           <thead>
             <tr>
                <th>No.</th>
                <th>Id.Trx</th>
                <th>Tanggal</th>
                <th>Group Trx</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
             </tr>
           </thead>
           <tbody>
             <?php 
             $no=0;         
             $total=0;    
             $tot_debet=0;
             $tot_kredit=0;
             $cash = 0;
             $ovo = 0;
             $transfer_bank = 0;
             $grab = 0;

              foreach ($all as $key) {

                if(trim($key->kategori)=='bubuk')
                {


                  $no++;
                  $total+=$key->saldo;
                  $tot_debet+=$key->debet;
                  $tot_kredit+=$key->kredit;

                  if($key->jenis_pembayaran=='cash')
                  {
                    $cash+=$key->debet;
                  }

                  if($key->jenis_pembayaran=='ovo')
                  {
                    $ovo+=$key->debet;
                  }

                  if($key->jenis_pembayaran=='transfer_bank')
                  {
                    $transfer_bank+=$key->debet;
                  }

                  if($key->jenis_pembayaran=='edc')
                  {
                    $grab+=$key->debet;
                  }


                  echo "
                    <tr>
                      <td>$no</td>
                      <td>$key->id</td>
                      <td>".tglindo($key->tanggal)."</td>
                      <td>$key->group_trx</td>
                      <td>$key->keterangan - $key->jenis_pembayaran</td>
                      <td>$key->kategori</td>
                      <td style='text-align:right'>".rupiah($key->debet)."</td>
                      <td style='text-align:right'>".rupiah($key->kredit)."</td>
                      <td style='text-align:right'>".rupiah($key->saldo)."</td>
                    </tr>
                  ";

                  }
                }
             ?>
             
           </tbody>
           <tfoot>
             <tr>
                <th colspan='6' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_debet)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_kredit)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></th>
             </tr>
           </tfoot>
         </table>

         <h3>Menurut Jenis Pembayaran - Sumatera Bubuk Kopi</h3>
         <table class="table table-bordered">
            <tr>
              <td>Cash</td><td align="right">Rp.<?php echo rupiah($cash)?></td>
            </tr>
            <tr>
              <td>OVO</td><td align="right">Rp.<?php echo rupiah($ovo)?></td>
             </tr>
             <tr>
              <td>EDC</td><td align="right">Rp.<?php echo rupiah($grab)?></td>
              </tr>
              <tr>
              <td>Transfer</td><td align="right">Rp.<?php echo rupiah($transfer_bank)?></td>
            </tr>
            <tr>
              <td><b>Total</b></td><td align="right"><b>Rp.<?php echo rupiah($transfer_bank+$cash+$ovo+$grab)?></b></td>
            </tr>
         </table>



<!--------batas --------->
<br><br>

<h3>Sumatera Cafe</h3>
<table class="table table-bordered" id="tbl_jurnal">
           <thead>
             <tr>
                <th>No.</th>
                <th>Id.Trx</th>
                <th>Tanggal</th>
                <th>Group Trx</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
             </tr>
           </thead>
           <tbody>
             <?php 
             $no=0;         
             $total=0;    
             $tot_debet=0;
             $tot_kredit=0;
             $cash = 0;
             $ovo = 0;
             $transfer_bank = 0;
             $grab = 0;

              foreach ($all as $key) {
                if(trim($key->kategori)=='cafe')
                {

                  $no++;
                  $total+=$key->saldo;
                  $tot_debet+=$key->debet;
                  $tot_kredit+=$key->kredit;

                  if($key->jenis_pembayaran=='cash')
                  {
                    $cash+=$key->debet;
                  }

                  if($key->jenis_pembayaran=='ovo')
                  {
                    $ovo+=$key->debet;
                  }

                  if($key->jenis_pembayaran=='transfer_bank')
                  {
                    $transfer_bank+=$key->debet;
                  }

                  if($key->jenis_pembayaran=='edc')
                  {
                    $grab+=$key->debet;
                  }

                  echo "
                    <tr>
                      <td>$no</td>
                      <td>$key->id</td>
                      <td>".tglindo($key->tanggal)."</td>
                      <td>$key->group_trx</td>
                      <td>$key->keterangan - $key->jenis_pembayaran</td>
                      <td>$key->kategori</td>
                      <td style='text-align:right'>".rupiah($key->debet)."</td>
                      <td style='text-align:right'>".rupiah($key->kredit)."</td>
                      <td style='text-align:right'>".rupiah($key->saldo)."</td>
                    </tr>
                  ";

                  }
                }
             ?>
             
           </tbody>
           <tfoot>
             <tr>
                <th colspan='6' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_debet)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_kredit)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></th>
             </tr>
           </tfoot>
         </table>





         <h3>Menurut Jenis Pembayaran - Sumatera Cafe</h3>
         <table class="table table-bordered">
            <tr>
              <td>Cash</td><td align="right">Rp.<?php echo rupiah($cash)?></td>
            </tr>
            <tr>
              <td>OVO</td><td align="right">Rp.<?php echo rupiah($ovo)?></td>
             </tr>
             <tr>
              <td>EDC</td><td align="right">Rp.<?php echo rupiah($grab)?></td>
              </tr>
              <tr>
              <td>Transfer</td><td align="right">Rp.<?php echo rupiah($transfer_bank)?></td>
            </tr>
            <tr>
              <td><b>Total</b></td><td align="right"><b>Rp.<?php echo rupiah($transfer_bank+$cash+$ovo+$grab)?></b></td>
            </tr>
            
         </table>




<!--------batas --------->
<br><br>

<h3>Diskon</h3>
<table class="table table-bordered" id="tbl_jurnal">
           <thead>
             <tr>
                <th>No.</th>
                <th>Id.Trx</th>
                <th>Tanggal</th>
                <th>Group Trx</th>
                <th>Keterangan</th>                
                
                <th>Kredit</th>
                
             </tr>
           </thead>
           <tbody>
             <?php 
             $no=0;         
             $diskon=0;    
             $total=0;    
             $tot_debet=0;
             $tot_kredit=0;
             
              foreach ($all as $key) {
                if(trim($key->id_group)=='9')
                {

                  $no++;
                  $total+=$key->saldo;
                  $tot_debet+=$key->debet;
                  $tot_kredit+=$key->kredit;

                  $diskon=$tot_kredit;
                  echo "
                    <tr>
                      <td>$no</td>
                      <td>$key->id</td>
                      <td>".tglindo($key->tanggal)."</td>
                      <td>$key->group_trx</td>
                      <td>$key->keterangan </td>                      
                      
                      <td style='text-align:right'>".rupiah($key->kredit)."</td>
                      
                    </tr>
                  ";

                  }
                }
             ?>
             
           </tbody>
           <tfoot>
             <tr>
                <th colspan='5' style='text-align:right'><b>Total</b></th>

                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_kredit)?></b></th>

             </tr>
           </tfoot>
         </table>


<!--------batas --------->


<!--
<br><br>
<br><br>

<h2>Total Keseluruhan</h2>
         <table class="table table-bordered" id="tbl_jurnal">
           <thead>
             <tr>
                <th>No.</th>
                <th>Id.Trx</th>
                <th>Tanggal</th>
                <th>Group Trx</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
             </tr>
           </thead>
           <tbody>
             <?php 
             $no=0;         
             $total=0;    
             $tot_debet=0;
             $tot_kredit=0;
             $cash = 0;
             $ovo = 0;
             $transfer_bank = 0;
             $grab = 0;

              foreach ($all as $key) {
                $no++;
                $total+=$key->saldo;
                $tot_debet+=$key->debet;
                $tot_kredit+=$key->kredit;

                if($key->jenis_pembayaran=='cash')
                {
                  $cash+=$key->debet;
                }

                if($key->jenis_pembayaran=='ovo')
                {
                  $ovo+=$key->debet;
                }

                if($key->jenis_pembayaran=='transfer_bank')
                {
                  $transfer_bank+=$key->debet;
                }

                if($key->jenis_pembayaran=='edc')
                {
                  $grab+=$key->debet;
                }

                echo "
                  <tr>
                    <td>$no</td>
                    <td>$key->id</td>
                    <td>".tglindo($key->tanggal)."</td>
                    <td>$key->group_trx</td>
                    <td>$key->keterangan - $key->jenis_pembayaran</td>
                    <td>$key->kategori</td>
                    <td style='text-align:right'>".rupiah($key->debet)."</td>
                    <td style='text-align:right'>".rupiah($key->kredit)."</td>
                    <td style='text-align:right'>".rupiah($key->saldo)."</td>
                  </tr>
                ";
              }
             ?>
             
           </tbody>
           <tfoot>
             <tr>
                <th colspan='6' style='text-align:right'><b>Total</b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_debet)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($tot_kredit)?></b></th>
                <th style='text-align:right'><b>Rp.<?php echo rupiah($total)?></b></th>
             </tr>
           </tfoot>
         </table>

         <h3>Jenis Pembayaran</h3>
         <table class="table table-bordered">
            <tr>
              <td>Cash</td><td align="right">Rp.<?php echo rupiah($cash)?></td>
            </tr>
            <tr>
              <td>OVO</td><td align="right">Rp.<?php echo rupiah($ovo)?></td>
             </tr>
             <tr>
              <td>EDC</td><td align="right">Rp.<?php echo rupiah($grab)?></td>
              </tr>
              <tr>
              <td>Transfer</td><td align="right">Rp.<?php echo rupiah($transfer_bank)?></td>
            </tr>
         </table>

-->

         

      </div>

      <input type="button" class="btn btn-primary" value="Download" id="download_pdf">
      <!-- /.box -->
    </div>
</section>
    <!-- /.content -->

<script type="text/javascript">
  /*
  $(document).ready(function(){
    $('#tbl_jurnal').dataTable(
      {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp.,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                'Rp.'+formatRupiah(pageTotal) +' (Rp.'+ formatRupiah(total) +')'
            );
        }
    } );
  })

*/
function formatRupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
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

    eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal_harian/?tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir,'Laporan Jurnal');
  return false;
})

$("html, body").animate({ scrollTop: 0 }, "slow");



$("#download_pdf").on("click",function(){
  var ser = $("#go_trx_jurnal").serialize();
  var url="<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal_harian_xl/?"+ser;
  window.open(url);

  return false;
})

</script>