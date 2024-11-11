<!DOCTYPE html>
<html>
<head>
	<title>Nusantara-Konoha</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
</head>
<body>
	<?php 
	include 'koneksi.php';
	?>
 
	<style type="text/css">
		body{
			font-family: "Roboto";
		}
	</style>
 
	<h2>Data Daerah Indonesia Dengan PHP, MySQL & Ajax <br> <a href="https://www.kodingin.com/menampilkan-data-daerah-indonesia-php-mysqli-ajax">www.kodingin.com</a></h2>
 
	<select id="form_prov">
		<option value="">Pilih Provinsi</option>
		<?php 
		$daerah = mysqli_query($koneksi,"SELECT kode,nama FROM wilayah_2022 WHERE CHAR_LENGTH(kode)=2 ORDER BY nama");
		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
			<?php 
		}
		?>
	</select>
 
	<select id="form_kab"></select>
 
	<select id="form_kec"></select>
 
	<select id="form_des"></select>
 
	<script type="text/javascript">
		$(document).ready(function(){
 
			// sembunyikan form kabupaten, kecamatan dan desa
			$("#form_kab").hide();
			$("#form_kec").hide();
			$("#form_des").hide();
 
			// ambil data kabupaten ketika data memilih provinsi
			$('body').on("change","#form_prov",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=kabupaten";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_kab").html(hasil);
						$("#form_kab").show();
						$("#form_kec").hide();
						$("#form_des").hide();
					}
				});
			});
 
			// ambil data kecamatan/kota ketika data memilih kabupaten
			$('body').on("change","#form_kab",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=kecamatan";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_kec").html(hasil);
						$("#form_kec").show();
						$("#form_des").hide();
					}
				});
			});
 
			// ambil data desa ketika data memilih kecamatan/kota
			$('body').on("change","#form_kec",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=desa";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_des").html(hasil);
						$("#form_des").show();
					}
				});
			});
 
 
		});
	</script>
</body>
</html>