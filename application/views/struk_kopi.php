<title><?php echo config_item('app_name')?></title>
<style>
html,body{
	margin:0px;
	padding:0px;
}
body,table{
	    text-transform: uppercase;
		font-size:8px;
		font-family:verdana;
}

font-size:10px;
</style>

<body onload='window.print();'>

<center>
	<?php //echo config_item('app_name')?>
	<?php echo config_item('app_client1')?>
	<br>
	<?php echo config_item('app_client2')?>
	<br>
	<?php echo config_item('app_client3')?>
	
</center>

<hr style="border-top: dotted 1px;" />

<table>
<tr>
	<td>Tanggal</td>
	<td>: <?php echo $data[0]->tgl_trx?></td>	
</tr>
<tr>	
	<td>No.TRX</td>
	<td>: <?php echo $data[0]->kode_trx?></td>	
</tr>

</table>
<hr style="border-top: dotted 1px;" />
<center>Daftar Belanja</center>
<table class="table" width="100%">
<tr>
	<td>ID</td>
	<td>Barang </td>	
	<td align=right>Harga </td>
	<td align=right>Qty </td>
	<td align=right>Sub Total </td>
</tr>
<?php 
	$tot = 0;

	foreach ($data as $key ) 
	{
		$tot+=($key->harga*$key->qty);
		echo "
				<tr>
					<td>$key->id</td>
					<td>$key->nama_barang [$key->berat]</td>					
					<td align=right> ".rupiah($key->harga)."</td>
					<td align=right>$key->qty</td>
					<td align=right> ".rupiah($key->harga*$key->qty)."</td>
					
				</tr>
		";

	}
	
	
	echo "
		<tr>
			<td colspan=4 align=right>Total</td>
			<td align=right><b>".rupiah($tot)."</b></td>
		</tr>
		
		
	";
?>
</table>

<hr style="border-top: dotted 1px;" />

<center>
	Selamat Belanja!
</center>

<br>
<hr style="border-top: dotted 1px;" />


<center>
	<?php //echo config_item('app_name')?>
	<?php echo config_item('app_client1')?>
	<br>
	<?php echo config_item('app_client2')?>
	<br>
	<?php echo config_item('app_client3')?>
	
</center>

<hr style="border-top: dotted 1px;" />
<table>
<tr>
	<td>Tanggal</td>
	<td>: <?php echo $data[0]->tgl_trx?></td>	
</tr>
<tr>	
	<td>No.TRX</td>
	<td>: <?php echo $data[0]->kode_trx?></td>	
</tr>

</table>
<hr style="border-top: dotted 1px;" />
<center>Daftar Belanja</center>
<table class="table" width="100%">
<tr>
	<td>ID</td>
	<td>Barang </td>	
	<td align=right>Harga </td>
	<td align=right>Qty </td>
	<td align=right>Sub Total </td>
</tr>
<?php 
	$tot = 0;

	foreach ($data as $key ) 
	{
		$tot+=($key->harga*$key->qty);
		echo "
				<tr>
					<td>$key->id</td>
					<td>$key->nama_barang [$key->berat]</td>					
					<td align=right> ".rupiah($key->harga)."</td>
					<td align=right>$key->qty</td>
					<td align=right> ".rupiah($key->harga*$key->qty)."</td>
					
				</tr>
		";

	}
	
	
	echo "
		<tr>
			<td colspan=4 align=right>Total</td>
			<td align=right><b>".rupiah($tot)."</b></td>
		</tr>
		
		
	";
?>
</table>

<hr style="border-top: dotted 1px;" />

<center>
	Selamat Belanja!
</center>


</body>

<script type="text/javascript">
	setTimeout(function(){window.close();},100);
</script>