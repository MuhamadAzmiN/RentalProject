<?php

class Rental {
	public $motor,
			$nama,
			$jamRental = 700000,
			$waktuRental = 2,
			$pajak = 10000,
			$member;
	public function __construct($motor, $nama, $jamRental, $waktuRental, $pajak, $member = ["azmi", "rifaldi", "yogi"])
	{
		$this->motor = $motor;
		$this->nama = $nama;
		$this->jamRental = $jamRental;
		$this->waktuRental = $waktuRental;
		$this->pajak = $pajak;
		$this->member = $member;
	}

	public function setRental()
	{
		return ($this->jamRental * $this->waktuRental);
	}

	public function setDiskon()
	{
		return ($this->setRental() * 5) / 100;
	}


	public function harga()
	{
		$diskon = null;
		if(in_array($this->nama, $this->member)){
			$hargaBeli =  ($this->setRental() - $this->setDiskon())+ $this->pajak;
			$diskon =  $this->nama ." Member Mendapatkan Diskon sebesar 5% Total Yang harus di bayarkan " . number_format($hargaBeli, 0, '.', '.') . "Jenis Motor " . $this->motor;
		}else {
			$hargaBeli =  ($this->setRental() - $this->setDiskon())+ $this->pajak;
			$diskon =   $this->nama . " Bukan Member  " . number_format($hargaBeli, 0, '.', '.') . "Jenis Motor" . $this->motor;
		}

		return $diskon;
	}

	
}
$nama = null;
$jenisMotor = null;
$rentalHarga = null;
if(isset($_POST["submit"])){
	$nama = $_POST["nama"];
	$lamaWaktu = $_POST["lamaWaktu"];
	$jenisMotor = $_POST["merek_motor"];
	$berhasil = "succes";

	$rental = new Rental($jenisMotor, $nama, 70000, $lamaWaktu, 10000 );	
	$rentalHarga = $rental->harga();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Motor</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
	h5 {
		text-align: center;
	}
</style>
<body>
<div class="container container-sm">
    <h2 class="text-center mb-4">Sewa Motor</h2>
    <form action="" method="post" class="mx-auto m-5" style="max-width: 400px; ">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Anda:</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="lamaWaktu" class="form-label">Lama Waktu Sewa (hari):</label>
            <input type="number" id="lamaWaktu" name="lamaWaktu" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="merek_motor" class="form-label">Pilih Merek Motor:</label>
            <select name="merek_motor" id="merek_motor" class="form-select">
                <option value="honda">Honda</option>
                <option value="yamaha">Yamaha</option>
                <option value="suzuki">Suzuki</option>
                <option value="kawasaki">Kawasaki</option>
                <option value="ducati">Ducati</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Sewa Sekarang</button>
    </form>
</div>
	<h5 ><?= $rentalHarga ;?></h5 >

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>