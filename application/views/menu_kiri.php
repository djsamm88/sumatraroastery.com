
        <li>
          <a href="<?php echo base_url()?>index.php/welcome">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>



        <?php 
        if($this->session->userdata('level')=='1')
        {
        ?>

        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/admin/data_admin','Master Admin');return false;">
            <i class="fa fa-lock"></i> <span>Master Admin</span>
          </a>
        </li>



        
        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Modal</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_penambahan_saldo','Penambahan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penambahan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_penarikan_saldo','Penarikan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penarikan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/form_koreksi','Koreksi Keuangan');return false;">
                <i class="fa fa-link"></i> <span>Koreksi Keuangan</span>
              </a>
            </li>


            
          </ul>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Pengeluaran</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/data','Master Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Data Pengeluaran</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/form_pengeluaran_bulanan','Form Transaksi');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan/trx_pengeluaran_bulanan/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Transaksi Pengeluaran');return false;">
                <i class="fa fa-link"></i> <span>Lap.Pengeluaran</span>
              </a>
            </li>

            
          </ul>
        </li>



        


        <li class="treeview">
          
          <a href="#"><i class="fa fa-database"></i> <span>Master <span class="label label-danger pull-right badge_barang"></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data','Master Barang');return false;">
                <i class="fa fa-link"></i> <span>Data Barang</span>
              </a>
            </li>

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/meja/data','Master Meja');return false;">
                <i class="fa fa-link"></i> <span>Data Meja</span>
              </a>
            </li>


            <!--
            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/data_beli','Pembelian Barang');return false;">
                <i class="fa fa-link"></i> <span>Barang Masuk <span class="label label-danger pull-right badge_barang_baru"></span></span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/barang_transaksi','Transaksi Barang');return false;">
                <i class="fa fa-link"></i> <span>Lap.Transaksi</span>
              </a>
            </li>

            -->


             
            



            
          </ul>
        </li>

        <!--

         <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/pesanan_member','Pesanan Member');return false;">
            <i class="fa fa-link"></i> <span>Pesanan  Member<span class="label label-danger pull-right badge_pesanan_member"></span></span>
          </a>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-users"></i> <span>Pelanggan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/Pelanggan/data','Master Pelanggan');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/Pelanggan/transaksi','Utang/Piutang');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>

            
            
          </ul>
        </li>



        <li class="treeview">
          
          <a href="#"><i class="fa fa-car"></i> <span>Ekspedisi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/ekspedisi/data','Master Ekspedisi');return false;">
                <i class="fa fa-link"></i> <span>Data</span>
              </a>
            </li>

            
          </ul>
        </li>
        -->


        

        <!--
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pembatalan/data_paket','Data Pembatalan');return false;">
            <i class="fa fa-remove"></i> <span>Pembatalan</span>
          </a>
        </li>
        -->



        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Laporan Keuangan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/kas','Saldo');return false;">
                <i class="fa fa-link"></i> <span>Saldo</span>
              </a>
            </li>

           

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Jurnal</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/arus_kas','Laporan Arus Kas');return false;">
                <i class="fa fa-link"></i> <span>Arus Kas</span>
              </a>
            </li>


            <!--
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_laba/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Laba Rugi');return false;">
                <i class="fa fa-link"></i> <span>Laba Rugi</span>
              </a>
            </li>
            -->



                        
          </ul>
        </li>

        







        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/meja/form_penjualan',' Kasir');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Kasir</span>
          </a>
        </li>


           <li>
            <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/meja/penjualan/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+2 days'));?>','Laporan Penjualan');return false;">
              <i class="fa fa-link"></i> <span>Penjualan</span>
            </a>
          </li>





        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/meja/kasir_agen',' Kasir Agen');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Agen</span>
          </a>
        </li>




        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/meja/cicilan_agen',' Kasir Agen');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Cicilan Agen</span>
          </a>
        </li>




            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-d')?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Harian');return false;">
                <i class="fa fa-link"></i> <span>Laporan Harian</span>
              </a>
            </li>

<hr>





        <li class="treeview">
          
          <a href="#"><i class="fa fa-institution"></i> <span>Master Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/jenis_kopi/data','Jenis Kopi');return false;">
                <i class="fa fa-link"></i> <span>Set Harga Kopi</span>
              </a>
            </li>

             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/gudang/data','Master Gudang');return false;">
                <i class="fa fa-link"></i> <span>Nama Gudang</span>
              </a>
            </li>


            
          </ul>
        </li>
      



        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Pengeluaran Gudang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan_gudang/data','Master Pengeluaran Gudang');return false;">
                <i class="fa fa-link"></i> <span>Data Pengeluaran</span>
              </a>
            </li>

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan_gudang/form_pengeluaran_bulanan_gudang','Form Transaksi Gudang');return false;">
                <i class="fa fa-link"></i> <span>Transaksi</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/pengeluaran_bulanan_gudang/trx_pengeluaran_bulanan_gudang/?jenis=&tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Transaksi Pengeluaran Gudang');return false;">
                <i class="fa fa-link"></i> <span>Lap.Pengeluaran</span>
              </a>
            </li>

            
          </ul>
        </li>


         
        <li class="treeview">
          
          <a href="#"><i class="fa fa-retweet"></i> <span>Kasir Gudang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

            
        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/gudang/kasir',' Kasir Gudang');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
          </a>
        </li>



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/gudang/kasir_beli',' Kasir Gudang');return false;">
            <i class="fa fa-shopping-cart"></i> <span>Pembelian</span>
          </a>
        </li>



        <li>
          <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/gudang/laporan_jual_beli/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Penjualan Pembelian');return false;">
            <i class="fa fa-link"></i> <span>Laporan</span>
          </a>
        </li>



        

        </ul>
      </li>
        




        
        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Modal Gudang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan_gudang/form_penambahan_saldo','Penambahan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penambahan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan_gudang/form_penarikan_saldo','Penarikan Modal');return false;">
                <i class="fa fa-link"></i> <span>Penarikan Modal</span>
              </a>
            </li>


            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan_gudang/form_koreksi','Koreksi Keuangan');return false;">
                <i class="fa fa-link"></i> <span>Koreksi Keuangan</span>
              </a>
            </li>


            
          </ul>
        </li>




        <li class="treeview">
          
          <a href="#"><i class="fa fa-dollar"></i> <span>Lap.Keuangan Gudang</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan_gudang/kas','Saldo');return false;">
                <i class="fa fa-link"></i> <span>Saldo</span>
              </a>
            </li>

           

            
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan_gudang/laporan_jurnal/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Jurnal');return false;">
                <i class="fa fa-link"></i> <span>Jurnal</span>
              </a>
            </li>


             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan_gudang/arus_kas','Laporan Arus Kas');return false;">
                <i class="fa fa-link"></i> <span>Arus Kas</span>
              </a>
            </li>


            <!--
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/laporan_keuangan/laporan_laba/?tgl_awal=<?php echo date('Y-m-').'01'?>&tgl_akhir=<?php echo date('Y-m-d',strtotime('+1 days'));?>','Laporan Laba Rugi');return false;">
                <i class="fa fa-link"></i> <span>Laba Rugi</span>
              </a>
            </li>
            -->



                        
          </ul>
        </li>

        




        

        
        <!--


        <li class="treeview">
          
          <a href="#"><i class="fa fa-institution"></i> <span>User Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>

          <ul class="treeview-menu">
             <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/form_barang_sementara','Barang Masuk');return false;">
                <i class="fa fa-lock"></i> <span>Barang Masuk</span>
              </a>
            </li>
            
            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/stok_gudang/1','Stok Gudang');return false;">
                <i class="fa fa-link"></i> <span>Stok Gudang <span class="label label-warning pull-right badge_gudang"></span></span></span>
              </a>
            </li>

            
            

            <li>
              <a href="#" onclick="eksekusi_controller('<?php echo base_url()?>index.php/barang/log_pindah_gudang','Log Gudang');return false;">
                <i class="fa fa-link"></i> <span>Log Perpindahan </span>
              </a>
            </li>
          </ul>
        </li>

      -->
        <?php 
          }

          if($this->session->userdata('level')=='2')
          {?>

            




         <?php 
          }
        ?>




        <?php 
          //kasir
          if($this->session->userdata('level')=='3')
          {?>



        <?php }?>


        


        <?php 
          if($this->session->userdata('level')=='4')
          {?>




        

        <?php }?>



        <?php 
          if($this->session->userdata('level')=='5')
          {?>


        <?php }?>


        
        
        <li>
          <a href="#">
             &nbsp;
          </a>
        </li>


            
           