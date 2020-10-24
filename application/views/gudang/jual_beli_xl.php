<h1>Laporan Stok Barang <?php echo $tgl_awal?> sd <?php echo $tgl_akhir?></h1>        
<table border=1>
      <thead>
        <tr>
              
              <th>No</th>                    
              <th>Nama Kopi</th>                     
              <th align=right>Total Masuk (Gram)</th>                     
              <th align=right>Total Keluar (Gram)</th>                     
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
           <br>
<table border=1>
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
              <th>Bukti Bayar</th>                    
              <th>Pembayaran</th>                     

              
              
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
                
                <td><a href='".base_url()."uploads/".$x->bukti."' target='blank'>$x->bukti</a></td>                                
                <td><a href='".base_url()."index.php/gudang/struk/".$x->kode_trx."' target='blank'>Print</a></td>  
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>       
  </table>