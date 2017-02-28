<?php

$data = DB::select("select date_format(tanggal, '%d / %m / %Y') as tanggal, aktivitas, verifikasi, siswa from mg_log_aktivitas where siswa=$siswa ");

FPDF::AddPage();
FPDF::SetFont('Arial','',10);


FPDF::Image('packages/tugumuda/images/dinustek.png',83,10,45,20);
FPDF::ln(25);
$alamat = "Jl. Arjuna No. 36 Semarang 50131, Indonesia";
$kontak = "Tel. (024) 3568492 Fax. (024) 3568490 Email: marketing@dinustech.com";
FPDF::Cell(0,0,$alamat,'0','1','C',false);
FPDF::ln(6);
FPDF::Cell(0,0,$kontak,'0','1','C',false);
FPDF::SetFont('Arial','B',14);
FPDF::ln(4);

$id_siswa = DB::table('ms_siswa_magang')
            ->Where('id', $siswa)
            ->first();

$id_magang = DB::table('ms_jenis_magang')
            ->Where('id', $id_siswa->nm_magang)
            ->first();

$siswa 			= $id_siswa->nm_siswa;
$asal_sekolah 	= $id_siswa->asal_sekolah;
$jenis_magang 	= $id_magang->nama;

FPDF::Ln(15);

FPDF::SetFont('Arial','',10);
FPDF::Cell(22,0,'Nama','0','1','L',false);
FPDF::Cell(30,0,' : ',0,0,'R');
FPDF::Cell(100,0,$siswa,0,0,':');
FPDF::Ln(6);
FPDF::Cell(22,0,'Asal Sekolah','0','1','L',false);
FPDF::Cell(30,0,' : ',0,0,'R');
FPDF::Cell(100,0,$asal_sekolah,0,0,':');
FPDF::Ln(6);
FPDF::Cell(22,0,'Jurusan','0','1','L',false);
FPDF::Cell(30,0,' : ',0,0,'R');
FPDF::Cell(100,0,$jenis_magang,0,0,':');
FPDF::Ln(10);

FPDF::Cell(10,7,'No',1,0,'C');
FPDF::Cell(35,7,'Tanggal',1,0,'C');
FPDF::Cell(110,7,'Aktivitas',1,0,'C');
FPDF::Cell(35,7,'Status',1,0,'C');
FPDF::Ln(7);

foreach ($data as $key => $log) {
	FPDF::Cell(10,7,$key+1,1,0,'C');
	FPDF::Cell(35,7,$log->tanggal,1,0,'C');
	FPDF::Cell(110,7," ".$log->aktivitas,1,0,'L');
	if ($log->verifikasi == 1) {
		FPDF::Cell(35,7,'Terverifikasi',1,0,'C');
	}else{
		FPDF::Cell(35,7,'-',1,0,'C');
	}
	FPDF::Ln(7);
}



FPDF::Output();
exit;
