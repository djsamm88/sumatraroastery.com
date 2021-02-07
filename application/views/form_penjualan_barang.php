
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="judul">
        
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
          <h3 class="box-title">Meja</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body ">
              
              <?php
                foreach ($all_meja as $meja) {

                  if($meja->ada_pesanan>0)
                  {
                    $alert='alert-danger';  

                  $tutup = "<button class='btn btn-primary btn-block'onclick='detail_pesanan($meja->id_meja)' > Bayar</button>";
                  $tambah = "<button class='btn btn-primary btn-block' onclick='tambah_menu($meja->id_meja)'> Tambah menu</button>";
                  $pindah = "<button class='btn btn-primary btn-block' onclick='pindah_meja($meja->id_meja)'> Pindah</button>";

                  $cetak = "<button class='btn btn-primary btn-block' onclick='cetak($meja->id_meja)'> Cetak</button>";

                  $cetak = "<button class='btn btn-warning btn-block' onclick='batal($meja->id_meja)'> Batal</button>";
                  }else{
                    $alert='alert-info';
                    $tutup = "";
                    $tambah = "<button class='btn btn-primary btn-block' onclick='tambah_menu($meja->id_meja)'> Tambah menu</button>";
                    $pindah = "";
                    $cetak = "";
                  }
                  

                  

                  echo "

                    <div class='col-sm-4'>
                      <div class='alert $alert text-center' style='min-height:230px;margin:5px'>
                        <b>$meja->nama_meja </b>
                          
                          <br>
                           $tambah 
                          
                          $tutup
                          
                          $pindah

                          $cetak

                          <div style='clear:both'></div><br>
                      </div>  
                    </div>

                  ";
                }
              ?>





        


      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->


<style type="text/css">
  @media (min-width: 768px) {
    .modal-lg {
      width: 90%;
     max-width:1200px;
    }
  }
</style>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Trx</h4>
      </div>
      <div class="modal-body">
          
          <div id="t4_buku_menu"></div>

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">

  function batal(id_meja)
  {
    if(confirm("Anda yakin membatalkan meja?"))
    {
      $.get("<?php echo base_url()?>index.php/meja/batal_meja/"+id_meja,function(e){
        eksekusi_controller('<?php echo base_url()?>index.php/meja/form_penjualan',' Kasir');
      })
    }
  }

  function cetak(id_meja)
  {
    window.open("<?php echo base_url()?>index.php/meja/struk_sebelum/"+id_meja);
  }

  function tambah_menu(id)
  {
    console.log(id);
    $.get("<?php echo base_url()?>index.php/meja/buku_menu/"+id,function(e){
      $("#t4_buku_menu").html(e);
    })
    $("#myModal").modal('show');

  }

  function detail_pesanan(id)
  {
    $.get("<?php echo base_url()?>index.php/meja/detail_pesanan/"+id,function(e){
      $("#t4_buku_menu").html(e);
    })
    $("#myModal").modal('show');
  }

  function pindah_meja(id)
  {
    $.get("<?php echo base_url()?>index.php/meja/pindah_meja/"+id,function(e){
      $("#t4_buku_menu").html(e);
    })
    $("#myModal").modal('show');
  }

  $("#myModal").on("hidden.bs.modal", function () {
    eksekusi_controller('<?php echo base_url()?>index.php/meja/form_penjualan',' Kasir');
  });
</script>