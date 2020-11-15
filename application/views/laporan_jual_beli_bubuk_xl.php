<h1>Stok </h1>
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border=1>
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Kopi</th>                     
              <th align=right>Total Masuk (Qty)</th>                     
              <th align=right>Total Keluar (Qty)</th>                     
              <th align=right>Stok</th>                                               
              
        </tr>
      </thead>
      <tbody>
        <?php
        $total=0;         
        $no = 0;
        foreach($stok_bubuk as $xx)
        {
          
          $no++;

 
            echo (" 
              
              <tr class='success'>
                <td>$no</td>                                
                <td>".($xx->nama_barang)."</td>                                
                <td align=right>".rupiah($xx->dibeli)."</td>                                
                <td align=right>".rupiah($xx->dijual)."</td>                                
                <td align=right>".rupiah($xx->dibeli-$xx->dijual)."</td>                                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>       
  </table>



<h3>Laporan Stok Bubuk <?php echo $tgl_awal?> sd <?php echo $tgl_akhir?></h3>        
<table id="tbl_datanya_barang" class="table  table-striped table-bordered"  cellspacing="0" width="100%" border="1">
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama</th>                     
              <th>Kode Trx</th>                     
                                                  
              <th>Tanggal</th>                                               
              
              <th>Kategori</th>                          
              <th>Qty</th>                          
              
                           

              
              
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
                <td>".($x->nama_barang)." </td>
                <td>".($x->kode_trx)." </td>
                
                
                <td>$x->tgl_trx</td> 
                                                                          
                <td>".($x->kategori_trx)."</td>
                <td>".($x->qty)."</td>
                
                
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>       
  </table>