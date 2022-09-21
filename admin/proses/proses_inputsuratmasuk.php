<?php
	session_start();
	include '../../koneksi/koneksi.php';
	
	$tanggalmasuk_suratmasuk	        = mysqli_real_escape_string($db,$_POST['tanggalmasuk_suratmasuk']);
	$kategori				                = mysqli_real_escape_string($db,$_POST['kategori']);
	$nomor_suratmasuk	                = mysqli_real_escape_string($db,$_POST['nomor_suratmasuk']);
    $judul                          = mysqli_real_escape_string($db,$_POST['judul']);

        date_default_timezone_set('Asia/Jakarta'); 
		$tanggal_entry  = date("Y-m-d H:i:s");
        $thnNow = date("Y");
	
	$nama_file_lengkap 		= $_FILES['file_suratmasuk']['name'];
	$nama_file 		= substr($nama_file_lengkap, 0, strripos($nama_file_lengkap, '.'));
	$ext_file		= substr($nama_file_lengkap, strripos($nama_file_lengkap, '.'));
	$tipe_file 		= $_FILES['file_suratmasuk']['type'];
	$ukuran_file 	= $_FILES['file_suratmasuk']['size'];
	$tmp_file 		= $_FILES['file_suratmasuk']['tmp_name'];
	
    $tgl_masuk                  = date('Y-m-d H:i:s', strtotime($tanggalmasuk_suratmasuk));
	
    if (!($tgl_masuk=='') and !($kategori =='') and !($nomor_suratmasuk =='') and !($judul =='')  and   
		($tipe_file == "application/pdf") and ($ukuran_file <= 10340000)){		
		
		$nama_baru = $thnNow.'-'.$nama_file_lengkap . $ext_file;
		$path = "../surat_masuk/".$nama_baru;
		move_uploaded_file( $path,$nama_file_lengkap);
		
		$sql = "INSERT INTO tb_suratmasuk(tanggalmasuk_suratmasuk, kategori, nomor_suratmasuk, judul, file_suratmasuk )
				values ('$tgl_masuk', '$kategori', '$nomor_suratmasuk', '$judul', '$path' );";
		$execute = mysqli_query($db, $sql);
		
		echo "<Center><h2><br>Terima Kasih<br>Surat masuk Telah Dimasukkan</h2></center>
			<meta http-equiv='refresh' content='2;url=../datasuratmasuk.php'>";
	}
	else{
		echo "<Center><h2>Silahkan isi semua kolom lalu tekan submit<br>Terima Kasih</h2></center>
			<meta http-equiv='refresh' content='2;url=../inputsuratmasuk.php'>";
	}
	
?>
	