<?php

 if((strlen($jenis) > 0) && (strlen($jenjang) > 0 ) && ($bulanml > 0) && ($bulansl > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_mulai) >= ?', [$bulanml])
                        ->whereRaw('extract(month from tgl_selesai) <= ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);  

            }else if((strlen($jenis) > 0) && (strlen($jenjang) > 0 ) && ($bulanml > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']);  

            }else if((strlen($jenis) > 0) && (strlen($jenjang) > 0 ) && ($bulansl > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);  

            }else if((strlen($jenis) > 0) && (strlen($jenjang) > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->Where('jenjang_pddk',  $jenjang)
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if((strlen($jenis) > 0) && ($bulanml > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if((strlen($jenis) > 0) && ($bulansl > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if((strlen($jenjang) > 0) && ($bulanml > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']); 

            }else if((strlen($jenjang) > 0) && ($bulansl > 0)){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('jenjang_pddk',  $jenjang)
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']); 

            }else if(strlen($jenis) > 0){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('nm_magang',  $jenis)
                        ->paginate($_ENV['configurations']['list-limit']);    

            }else if(strlen($jenjang) > 0){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->Where('jenjang_pddk',  $jenjang)
                        ->paginate($_ENV['configurations']['list-limit']); 

            }else if(strlen($bulanml) > 0){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->whereRaw('extract(month from tgl_mulai) = ?', [$bulanml])
                        ->paginate($_ENV['configurations']['list-limit']);                        
            }else if(strlen($bulansl) > 0){
                $laporansiswamagang = DB::table('ms_siswa_magang')
                        ->whereRaw('extract(month from tgl_selesai) = ?', [$bulansl])
                        ->paginate($_ENV['configurations']['list-limit']);                        
            }

FPDF::AddPage("L",array(216,270));
FPDF::SetFont('Arial','',10);


FPDF::Image('packages/tugumuda/images/dinustek.png',115,10,45,20);
FPDF::ln(25);
$alamat = "Jl. Arjuna No. 36 Semarang 50131, Indonesia";
$kontak = "Tel. (024) 3568492 Fax. (024) 3568490 Email: marketing@dinustech.com";
FPDF::Cell(0,0,$alamat,'0','1','C',false);
FPDF::ln(5);
FPDF::Cell(0,0,$kontak,'0','1','C',false);

FPDF::Ln(15);
FPDF::SetFont('Arial','B',11);
FPDF::Cell(7.5,9,'No',1,0,'C');
FPDF::Cell(45,9,'Nama Siswa',1,0,'C');
FPDF::Cell(54,9,'Asal Sekolah',1,0,'C');
FPDF::Cell(28,9,'Pendidikan',1,0,'C');
FPDF::Cell(34,9,'Jenis Magang',1,0,'C');
FPDF::Cell(36,9,'Tanggal Mulai',1,0,'C');
FPDF::Cell(36,9,'Tanggal Selesai',1,1,'C');
FPDF::SetFont('Arial','',10);

if (is_null($laporansiswamagang ) == true) {
    foreach ($laporansiswamagang as $key => $log) {
    	$jjg=  SiswamagangModel::get_jenjang($log->jenjang_pddk);
    	$jns=  JenismagangModel::get_jenis_magang($log->nm_magang);
    	FPDF::Cell(7.5, 6, $key+1, 1, 0, 'C');	
    	FPDF::Cell(45, 6, $log->nm_siswa, 1, 0, 'L');
    	FPDF::Cell(54, 6, $log->asal_sekolah, 1, 0, 'C');
    	FPDF::Cell(28, 6, $jjg, 1, 0, 'C');
    	FPDF::Cell(34, 6, $jns, 1, 0, 'C');
    	FPDF::Cell(36, 6, date('d F Y', strtotime($log->tgl_mulai)), 1, 0, 'C');
    	FPDF::Cell(36, 6, date('d F Y', strtotime($log->tgl_selesai)), 1, 1, 'C');
    }
} else {
FPDF::SetFont('Arial','B',16);
FPDF::Cell(240.5,15,'Data Kosong',1,0,'C');
}
FPDF::Output();
exit;
