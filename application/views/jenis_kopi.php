
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
          <h3 class="box-title">Data</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              <button class="btn btn-primary" id="tambah_data"  onclick="tambah_admin()">Tambah Data</button> 
<table id="tbl_newsnya" class="table  table-striped table-bordered"  cellspacing="0" width="100%">
      <thead>
        <tr>
              
              <th>No</th>
               <th width="100px">id</th>
                <th>nama_kopi</th>                
                <th>Harga beli/Gram</th>                
                <th>Harga jual/Gram</th>                
                <th>Harga jual ke Kafe/Gram</th>                
              <th>Action</th>
              
        </tr>
      </thead>
      <tbody>
        <?php         
        $no = 0;
        foreach($all as $x)
        {
          $btn = "<button class='btn btn-warning btn-xs' onclick='edit_admin($x->id);return false;'>Edit</button>
                 <!-- 
                 <button class='btn btn-danger btn-xs' onclick='hapus_admin($x->id);return false;'>Hapus</button>
                 -->
                 ";

          $no++;

            echo (" 
              
              <tr>
                <td>$no</td>
                <td>$x->id</td>
                <td>$x->nama_kopi</td>                          
                <td>".rupiah($x->harga_beli)."</td>                          
                <td>".rupiah($x->harga_jual)."</td>                          
                <td>".rupiah($x->harga_jual_ke_cafe)."</td>                          

                <td>
                  $btn
                </td>
              </tr>
          ");
          
        }
        
        
        ?>
      </tbody>
  </table>


        </div>
        
      </div>
      <!-- /.box -->

</section>
    <!-- /.content -->




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form</h4>
      </div>
      <div class="modal-body">
          <form id="form_pelanggan">
            <input type="hidden" name="id" id="id" class="form-control" readonly="readonly">
            
            <div class="col-sm-4 judul">nama_kopi</div>
            <div class="col-sm-8">
              <input class="form-control" name="nama_kopi" id="nama_kopi" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">harga beli/gram</div>
            <div class="col-sm-8">
              <input class="form-control nomor" name="harga_beli" id="harga_beli" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">harga jual/gram</div>
            <div class="col-sm-8">
              <input class="form-control nomor" name="harga_jual" id="harga_jual" required>
            </div>
            <div style="clear:both"></div>
            <br>


            <div class="col-sm-4 judul">harga ke Cafe/gram</div>
            <div class="col-sm-8">
              <input class="form-control nomor" name="harga_jual_ke_cafe" id="harga_jual_ke_cafe" required>
            </div>
            <div style="clear:both"></div>
            <br>

            <div id="t4_info_form"></div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
          </form>

          <div style="clear: both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd' 
})
hanya_nomor(".nomor");
/***** menghapus garis bawah ******/
$('.judul,th').text(function(i, text) {    
    return text.replace(/_/g, ' ');
});
/***** menghapus garis bawah ******/

/***** membesarkan ******/
$('.judul,th').text(function(i, text) {
    return text.toUpperCase();    
});
/***** membesarkan ******/



$(document).ready(function(){

  $('#tbl_newsnya').dataTable();

});

function edit_admin(id)
{
  $.get("<?php echo base_url()?>index.php/jenis_kopi/by_id/"+id,function(e){
    //console.log(e[0].id_desa);
    $("#id").val(e[0].id);
    $("#nama_kopi").val(e[0].nama_kopi);    
    $("#harga_beli").val(e[0].harga_beli);    
    $("#harga_jual").val(e[0].harga_jual);    
    $("#harga_jual_ke_cafe").val(e[0].harga_jual_ke_cafe);    

    
    
  })
  $("#myModal").modal('show');
}

function tambah_admin()
{
  $("#id").val("");
  $("#nama_kopi").val("");
  $("#reminder").val("");
  
  
  $("#myModal").modal('show');
}

function hapus_admin(id)
{
  if(confirm("Anda yakin menghapus?"))
  {
    $.get("<?php echo base_url()?>index.php/jenis_kopi/hapus/"+id,function(e){
      eksekusi_controller('<?php echo base_url()?>index.php/jenis_kopi/data');
    })  
  }
  
}

$("#form_pelanggan").on("submit",function(){
  $("#t4_info_form").html('Loading...');
  

  var ser = $(this).serialize();

  $.post("<?php echo base_url()?>index.php/jenis_kopi/simpan",ser,function(x){
    console.log(x);
    
      $("#t4_info_form").html("<div class='alert alert-success'>Berhasil.</div>").fadeIn().delay(3000).fadeOut();

      setTimeout(function(){
        $("#myModal").modal('hide');
      },3000);
    
  })

  return false;
})


$("#myModal").on("hidden.bs.modal", function () {
  eksekusi_controller('<?php echo base_url()?>index.php/jenis_kopi/data','Data jenis_kopi');
});
</script>
