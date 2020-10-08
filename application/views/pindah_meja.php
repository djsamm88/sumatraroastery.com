<b>Pilih meja tujuan:</b>
<br>

 <?php
                foreach ($all_meja as $meja) {

                  if($meja->ada_pesanan>0)
                  {
                    
                  }else{
                    echo "
                            <div class='col-sm-4'>
                            <div class='alert alert-info text-center' style='min-height:100px;margin:5px'>
                                <b>$meja->nama_meja [$meja->id_meja]</b><br>
                                <button class='btn btn-success' onclick='pilih_meja($meja->id_meja)'>Pilih</button>
                                <div style='clear:both'></div><br>
                            </div>  
                          </div>

                    ";
                  }
                  
                }
              ?>
<div style='clear:both'></div><br>
<div id='info'></div>
<script type="text/javascript">
  function pilih_meja(id_meja)
  {
    if(confirm("Anda yakin pindah meja?"))
    {
      console.log(id_meja);
      var ser = {id_meja:id_meja,id_meja_lama:'<?php echo $id?>'};
      $.post("<?php echo base_url()?>index.php/meja/go_pindah_meja",ser,function(e){
        $("#info").html("<div class='alert alert-success'>Berhasil menyimpan!</div>");
        
      })
    }
  }
</script>