

<?php 
if($id==6){
  foreach ($menu_roasting as $roasting) {
    
                  echo "

                    <div class='col-sm-3'>
                      <div class='alert text-center' style='min-height:150px;margin:5px;border:1px solid #aaa'>
                        <b>$roasting->nama_barang</b><br>
                          <img src='".base_url()."uploads/".$roasting->gambar."' class='img img-rounded'  height='130px' width='130px'>
                          <br><b>Rp.".rupiah($roasting->harga_pokok)."
                            <input type='hidden' value='$roasting->harga_pokok' id='harga_pokok'>
                          </b>
                          <div class='row'>
                            <div class='col-xs-6'>
                            <input type='number' name='qty' class='form-control' id='qty' placeholder='Jumlah' value='1' >
                            </div>
                            <div class='col-xs-6'>
                              <div id='jum_order' class='text-right' >Jumlah</div>
                            </div>
                            </div>
                          <input type='hidden'  value='$roasting->id' id='id'>
                          
                          <button class='btn btn-success btn-block' id='order_menu' onclick='order_roasting($(this))'>Order</button>
                          <small><i>Untuk mengurangi, gunakan minus (-)</i></small>
                          <div style='clear:both'></div><br>
                      </div>  
                    </div>

                  ";
  }
}else if($id==7)
{
?>


<div style='clear:both'></div><br>
<br>
<b>Oleh-oleh Kopi Medan: </b><br>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Berat (gram)</th>
        <th>Qty</th>
        <th>Order</th>
        <th>Action</th>

        
    </tr>
  </thead>
<tbody>

<?php 
  $no = 0;  
  foreach ($menu_kopi as $kopi) {
    $no++;

    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$kopi->nama_barang</td>
        <td class='success text-right'>".rupiah($kopi->harga_pokok)."</td>
        <td class='info text-right' width='200px'>$kopi->berat</td>
        <td class='danger' width='100px'>
          <input type='number' name='qty' class='form-control' placeholder='Jumlah' value='1' id='qty'>
          <input type='hidden'  value='$kopi->id' id='id'>
          <input type='hidden' value='$kopi->harga_pokok' id='harga_pokok'>
          <input type='hidden'  value='$kopi->berat' id='berat'>
          
        </td>
        <td class='danger' width='100px' id='jum_order'>
        
        </td>
        <td class='' width='100px'>
          <button  class='btn btn-success btn-block ' id='order_kopi' onclick='order_kopi($(this))'>Order</button>
        </td>
      </tr>
    ";
  }
?>


</tbody>
</table>



<?php
}else{
?>


<div style='clear:both'></div><br>
<br>
<b>Menu Cafe: </b><br>
<table class="table table-bordered table-striped" id="dataMenu">
  <thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Berat (gram)</th>
        <th>Qty</th>
        <th>Order</th>
        <th>Action</th>

        
    </tr>
  </thead>
<tbody>

<?php
    $no=0;
foreach ($menu_menu as $menu) {
    $no++;
    /*
                  echo "

                    <div class='col-sm-3'>
                      <div class='alert text-center' style='min-height:150px;margin:5px;border:1px solid #aaa'>
                        <b>$menu->nama_barang</b><br>
                          <img src='".base_url()."uploads/".$menu->gambar."' class='img img-rounded'  height='130px' width='130px'>
                          <br><b>Rp.".rupiah($menu->harga_pokok)."
                            <input type='hidden' value='$menu->harga_pokok' id='harga_pokok'>
                          </b>
                          <div class='row'>
                            <div class='col-xs-6'>
                            <input type='number' name='qty' class='form-control' id='qty' placeholder='Jumlah' value='1' >
                            </div>
                            <div class='col-xs-6'>
                              <div id='jum_order' class='text-right' >Jumlah</div>
                            </div>
                            </div>
                          
                          <input type='hidden'  value='$menu->id' id='id'>
                          <input type='hidden'  value='$menu->berat' id='berat'>
                          <button class='btn btn-success btn-block' id='order_menu' onclick='order($(this))'>Order</button>
                          <small><i>Untuk mengurangi, gunakan minus (-)</i></small>
                          <div style='clear:both'></div><br>
                      </div>  
                    </div>

                  ";
                  
                  */
                  
                  
          
    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$menu->nama_barang</td>
        <td class='success text-right'>".rupiah($menu->harga_pokok)."</td>
        <td class='info text-right' width='200px'>$menu->berat</td>
        <td class='danger' width='100px'>
          <input type='number' name='qty' class='form-control' placeholder='Jumlah' value='1' id='qty'>
          <input type='hidden'  value='$menu->id' id='id'>
          <input type='hidden' value='$menu->harga_pokok' id='harga_pokok'>
          <input type='hidden'  value='$menu->berat' id='berat'>
          
          
        </td>
        <td class='danger' width='100px' id='jum_order'>
        
        </td>
        <td class='' width='100px'>
          <button  class='btn btn-success btn-block ' id='order_menu' onclick='order($(this))'>Order</button>
        </td>
      </tr>
    ";
    
  }
  
  ?>

</tbody>
</table>


<div style='clear:both'></div><br>
<br>
<b>Menu Cafe Tambahan: </b><br>
<table class="table table-bordered table-striped" id="dataTitip">
  <thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Berat (gram)</th>
        <th>Qty</th>
        <th>Order</th>
        <th>Action</th>

        
    </tr>
  </thead>
<tbody>
<?php
$no=0;
  foreach ($menu_titipan as $titipan) {
      $no++;
    /*
                  echo "

                    <div class='col-sm-3'>
                      <div class='alert text-center' style='min-height:150px;margin:5px;border:1px solid #aaa'>
                        <b>$titipan->nama_barang</b><br>
                          <img src='".base_url()."uploads/".$titipan->gambar."' class='img img-rounded'  height='130px' width='130px'>
                          <br><b>Rp.".rupiah($titipan->harga_pokok)."
                            <input type='hidden' value='$titipan->harga_pokok' id='harga_pokok'>
                          </b>
                          <div class='row'>
                            <div class='col-xs-6'>
                            <input type='number' name='qty' class='form-control' id='qty' placeholder='Jumlah' value='1' >
                            </div>
                            <div class='col-xs-6'>
                              <div id='jum_order' class='text-right' >Jumlah</div>
                            </div>
                            </div>
                          <input type='hidden'  value='$titipan->id' id='id'>
                          

                          <button class='btn btn-success btn-block' id='order_menu' onclick='order($(this))'>Order</button>
                          <small><i>Untuk mengurangi, gunakan minus (-)</i></small>
                          <div style='clear:both'></div><br>
                      </div>  
                    </div>

                  ";
                  
                  */
                  
                  
    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$titipan->nama_barang</td>
        <td class='success text-right'>".rupiah($titipan->harga_pokok)."</td>
        <td class='info text-right' width='200px'>$titipan->berat</td>
        <td class='danger' width='100px'>
          <input type='number' name='qty' class='form-control' placeholder='Jumlah' value='1' id='qty'>
          <input type='hidden'  value='$titipan->id' id='id'>
          <input type='hidden' value='$titipan->harga_pokok' id='harga_pokok'>
          <input type='hidden'  value='$titipan->berat' id='berat'>
          
          
        </td>
        <td class='danger' width='100px' id='jum_order'>
        
        </td>
        <td class='' width='100px'>
          <button  class='btn btn-success btn-block ' id='order_menu' onclick='order($(this))'>Order</button>
        </td>
      </tr>
    ";
    
  }?>
  
  
</tbody>
</table>


<div style='clear:both'></div><br>
<br>
<b>Oleh-oleh Kopi Medan: </b><br>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
        <th>No</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Berat (gram)</th>
        <th>Qty</th>
        <th>Order</th>
        <th>Action</th>

        
    </tr>
  </thead>
<tbody>

<?php 
  $no = 0;  
  foreach ($menu_kopi as $kopi) {
    $no++;

    echo "
      <tr>
        <td width='10px'>$no</td>
        <td class='warning'>$kopi->nama_barang</td>
        <td class='success text-right'>".rupiah($kopi->harga_pokok)."</td>
        <td class='info text-right' width='200px'>$kopi->berat</td>
        <td class='danger' width='100px'>
          <input type='number' name='qty' class='form-control' placeholder='Jumlah' value='1' id='qty'>
          <input type='hidden'  value='$kopi->id' id='id'>
          <input type='hidden' value='$kopi->harga_pokok' id='harga_pokok'>
          <input type='hidden'  value='$kopi->berat' id='berat'>
          
        </td>
        <td class='danger' width='100px' id='jum_order'>
        
        </td>
        <td class='' width='100px'>
          <button  class='btn btn-success btn-block ' id='order_kopi' onclick='order_kopi($(this))'>Order</button>
        </td>
      </tr>
    ";
  }
?>


</tbody>
</table>



<?php

   foreach ($menu_roasting as $roasting) {
    
                  echo "

                    <div class='col-sm-3'>
                      <div class='alert text-center' style='min-height:150px;margin:5px;border:1px solid #aaa'>
                        <b>$roasting->nama_barang</b><br>
                          <img src='".base_url()."uploads/".$roasting->gambar."' class='img img-rounded'  height='130px' width='130px'>
                          <br><b>Rp.".rupiah($roasting->harga_pokok)."
                            <input type='hidden' value='$roasting->harga_pokok' id='harga_pokok'>
                          </b>
                          <div class='row'>
                            <div class='col-xs-6'>
                            <input type='number' name='qty' class='form-control' id='qty' placeholder='Jumlah' value='1' >
                            </div>
                            <div class='col-xs-6'>
                              <div id='jum_order' class='text-right' >Jumlah</div>
                            </div>
                            </div>
                          <input type='hidden'  value='$roasting->id' id='id'>
                          
                          <button class='btn btn-success btn-block' id='order_menu' onclick='order_roasting($(this))'>Order</button>
                          <small><i>Untuk mengurangi, gunakan minus (-)</i></small>
                          <div style='clear:both'></div><br>
                      </div>  
                    </div>

                  ";
  }


}
?>



<script type="text/javascript">

$('#dataMenu').dataTable();
  function order(ini)
  {
      /*
    var jum_awal  = parseInt(ini.parent().find("#jum_order").text()) || 0;
    var jum_order = parseInt(ini.parent().find("#qty").val()) || 0;
    var harga_pokok = parseInt(ini.parent().find("#harga_pokok").val()) || 0;

    ini.parent().find("#jum_order").html(jum_awal+jum_order);
    console.log(jum_order);

    //ini.attr("disabled","disabled");

    ini.parent().find("#qty").val('');
    var id = parseInt(ini.parent().find("#id").val()) || 0;
    var jenis = "cafe";
    var berat = parseInt(ini.parent().find("#berat").val()) || 0;
    var ser = {qty:jum_order,id_barang:id,id_meja:<?php echo $id?>,harga_pokok:harga_pokok,berat:berat,jenis:jenis};
    $.post("<?php echo base_url()?>index.php/meja/order",ser,function(){

    })
    */
    
     ini.parent().find("#qty").val('');
    var jum_order = parseInt(ini.parent().parent().find("td #qty").val()) || 0;
    var jum_awal  = parseInt(ini.parent().parent().find("#jum_order").text()) || 0;
    var harga_pokok  = parseInt(ini.parent().parent().find("td #harga_pokok").val()) || 0;

    
    ini.parent().parent().find("#jum_order").html(jum_awal+jum_order);
    ini.parent().parent().find("#qty").val('');

    var id = parseInt(ini.parent().parent().find("td #id").val()) || 0;
    var berat = parseInt(ini.parent().parent().find("td #berat").val()) || 0;
    var jenis = "cafe";
    var ser = {qty:jum_order,id_barang:id,id_meja:<?php echo $id?>,harga_pokok:harga_pokok,berat:berat,jenis:jenis};
    $.post("<?php echo base_url()?>index.php/meja/order",ser,function(){

    })
    
  }


  function order_roasting(ini)
    {
    var jum_awal  = parseInt(ini.parent().find("#jum_order").text()) || 0;
    var jum_order = parseInt(ini.parent().find("#qty").val()) || 0;
    var harga_pokok = parseInt(ini.parent().find("#harga_pokok").val()) || 0;

    ini.parent().find("#jum_order").html(jum_awal+jum_order);
    console.log(jum_order);

    //ini.attr("disabled","disabled");

    ini.parent().find("#qty").val('');
    var id = parseInt(ini.parent().find("#id").val()) || 0;
    var jenis = "bubuk";
    var ser = {qty:jum_order,id_barang:id,id_meja:<?php echo $id?>,harga_pokok:harga_pokok,jenis:jenis};
    $.post("<?php echo base_url()?>index.php/meja/order",ser,function(){

    })
    
  }


  function order_kopi(ini)
  {
    
    ini.parent().find("#qty").val('');
    var jum_order = parseInt(ini.parent().parent().find("td #qty").val()) || 0;
    var jum_awal  = parseInt(ini.parent().parent().find("#jum_order").text()) || 0;
    var harga_pokok  = parseInt(ini.parent().parent().find("td #harga_pokok").val()) || 0;

    
    ini.parent().parent().find("#jum_order").html(jum_awal+jum_order);
    ini.parent().parent().find("#qty").val('');

    var id = parseInt(ini.parent().parent().find("td #id").val()) || 0;
    var berat = parseInt(ini.parent().parent().find("td #berat").val()) || 0;
    var jenis = "bubuk";
    var ser = {qty:jum_order,id_barang:id,id_meja:<?php echo $id?>,harga_pokok:harga_pokok,berat:berat,jenis:jenis};
    $.post("<?php echo base_url()?>index.php/meja/order",ser,function(){

    })
    
  }
</script>