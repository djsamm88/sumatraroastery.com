<?php 
  if($jenis=="")
  {
    $j="Semua Kategori ";
  }else{
    $j="Kategori $jenis";
  }
?>


<h1>Laporan Pengelurana <?php echo $j?> Tgl <?php echo $tgl_awal?> s/d <?php echo $tgl_akhir?>
<table id="tbl_datanyax" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border='1'>
     <thead>
        <tr>
              
              <th>No</th>                    
              <th>Tanggal</th>                     
              <th>Pengeluaran</th>                                                 
              <th>Keterangan</th>                                                 
              <th>Berat</th>                                                 
              <th>Jumlah</th>                     
              
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        $tot= 0;
        $tot_berat= 0;
        foreach($all as $x)
        {
          $no++;
          $tot+=$x->jumlah;
          $tot_berat+=$x->berat;
            
            echo (" 
              
              <tr>
                <td>$no</td>                
                <td>".tglindo($x->tgl_update)."</td>
                <td>$x->nama_pengeluaran</td>                                
                <td>$x->keterangan</td>            
                <td style='text-align:right'>".rupiah($x->berat)."</td>                          
                <td style='text-align:right'>".rupiah($x->jumlah)."</td>                                
              </tr>
          ");
          
        }        
        ?>
        <tbody>
          <tr>
            <td colspan="4" align="right">Total</td>
            <td align="right"><?php echo rupiah($tot_berat)?></td>
            <td align="right">Rp<?php echo rupiah($tot)?></td>
          </tr>
        </tbody>
      </tbody>
  </table>
