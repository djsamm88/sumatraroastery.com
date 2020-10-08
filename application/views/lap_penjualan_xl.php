
<h1>Laporan penjualan <?php echo $tgl_awal?> sd <?php echo $tgl_akhir?></h1>
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
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


