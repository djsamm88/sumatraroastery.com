<link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<style>
body{
  font-size: 12px;
}

table tr td, th  { 
  
  font-size: 12px; padding:5px;
  

}
table th{
      text-align: center;
      
    }

td {
      
      padding:5px;
      
    }
</style>

    
    <div class="text-center" style="font-weight:bold;font-size: 14">      
        JURNAL TANGGAL <?php echo tglindo($tgl_awal)?> S/D <?php echo tglindo($tgl_akhir)?>
    </div>
    <br>
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
                    $cash-=$key->kredit;
                  }

                  if($key->jenis_pembayaran=='ovo')
                  {
                    $ovo+=$key->debet;
                    $ovo-=$key->kredit;
                  }

                  if($key->jenis_pembayaran=='transfer_bank')
                  {
                    $transfer_bank+=$key->debet;
                    $transfer_bank-=$key->kredit;
                  }

                  if($key->jenis_pembayaran=='edc')
                  {
                    $grab+=$key->debet;
                    $grab-=$key->kredit;
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
                    $cash-=$key->kredit;
                  }

                  if($key->jenis_pembayaran=='ovo')
                  {
                    $ovo+=$key->debet;
                    $ovo-=$key->kredit;
                  }

                  if($key->jenis_pembayaran=='transfer_bank')
                  {
                    $transfer_bank+=$key->debet;
                    $transfer_bank-=$key->kredit;
                  }

                  if($key->jenis_pembayaran=='edc')
                  {
                    $grab+=$key->debet;
                    $grab-=$key->kredit;
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




