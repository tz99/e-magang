<?php

function uang($nominal = ''){
    if ($nominal == ''){
        return '';
    }
    else{
        return '&nbsp;'.number_format($nominal,0,',','.');        
    }
}

function debug($s='',$die=true){
    echo '<pre>';
    print_r($s);
    echo '</pre>';
    if($die == true){
        die();
    }
}

function kuda($namakuda = ''){
    //tes
}

function jam_tabrakan($s1='',$e1='',$s2='',$e2=''){
    if(
            ($s1 == $s2 || $e1 == $e2) ||
            ($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2) ||
//            ($s1 >= $s2 && $e1 >= $e2 && $s1 <= $e2) ||
            ($s1 >= $s2 && $e1 >= $e2 && $s1 < $e2) ||
            ($s1>=$s2 && $e1<=$e2) ||
            ($s1<=$s2 && $e1>=$e2)
            ){
//        if(($s1 == $s2 || $e1 == $e2)){
//            echo 'Kondisi 1<br>';
//        }
//        if($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2){
//            echo 'Kondisi 2<br>';
//        }
//        if($s1 >= $s2 && $e1 >= $e2 && $s1 < $e2){
//            echo 'Mulai 1 = '.$s1.'<br>';
//            echo 'Selesai 1 = '.$e1.'<br>';
//            echo 'Mulai 2 = '.$s2.'<br>';
//            echo 'Selesai 2 = '.$e2.'<br>';
//            echo 'Kondisi 3<br>';
//        }
//        if($s1>=$s2 && $e1<=$e2){
//            echo 'Kondisi 4<br>';
//        }
//        if($s1<=$s2 && $e1>=$e2){
//            echo 'Kondisi 5<br>';
//        }
        return true;
            }else{
        return false;
            }
//    if(
//            ($s1 == $s2 || $e1 == $e2) ||
//            ($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2) ||
//            ($s1 >= $s2 && $e1 >= $e2 && $s1 <= $e2) ||
//            ($s1>=$s2 && $e1<=$e2) ||
//            ($s1<=$s2 && $e1>=$e2)
//            ){
//        return true;
//            }else{
//        return false;
//            }
}

/* aku sholikhin */
function kampret(){
	
}

function rangesNotOverlapClosed($start_time1,$end_time1,$start_time2,$end_time2){
  $utc = new DateTimeZone('UTC');

  $start1 = new DateTime($start_time1,$utc);
  $end1 = new DateTime($end_time1,$utc);
  if($end1 < $start1)
    throw new Exception('Range is negative.');

  $start2 = new DateTime($start_time2,$utc);
  $end2 = new DateTime($end_time2,$utc);
  if($end2 < $start2)
    throw new Exception('Range is negative.');
  return ($end1 < $start2) || ($end2 < $start1);
}

function rangesNotOverlapOpen($start_time1,$end_time1,$start_time2,$end_time2)
{
  $utc = new DateTimeZone('UTC');

  $start1 = new DateTime($start_time1,$utc);
  $end1 = new DateTime($end_time1,$utc);
  if($end1 < $start1)
    throw new Exception('Range is negative.');

  $start2 = new DateTime($start_time2,$utc);
  $end2 = new DateTime($end_time2,$utc);
  if($end2 < $start2)
    throw new Exception('Range is negative.');

  return ($end1 <= $start2) || ($end2 <= $start1);
}



function rentang($h = ''){
    $huruf = array('A'=> 4,'B'=>3,'C' => 2, 'D' => 1,'E'=>0);
    return @$huruf[$h];
}

function konversi_nilai($angkatan = '2015', $nilai = 100){
    $data = \Session::get('range_nilai');
    $huruf = 'E';
    foreach($data as $d){
        if($d->angkatan_awal <= $angkatan && $d->angkatan_akhir >= $angkatan){
            if($nilai >= $d->angka_awal && $nilai <= $d->angka_akhir){
                $huruf = $d->huruf;
            }
        }
    }
    return $huruf;
}

function konversi_ta($ta = ''){
    return substr($ta, 0,4).((substr($ta, 4,1)=='1')?' Ganjil':' Genap');
}

function jatah_sks($h = ''){
    if($h >= 3){
        return 24;
    }elseif($h >= 2.5 && $h < 2.99){
        return 22;
    }elseif($h >= 2 && $h < 2.49){
        return 20;
    }else{
        return 18;
    }
}

function searchMataKuliah($id="", $text="",$name='id_mk',$url = '/masterdata/dataskpd/jsonskpd'){
	$str="";	
	//if (\PermissionsLibrary::hasPermission('mod-skpd-choose')){
            $str.= Form::hidden($name, null);
            $str.= "<script>
                autoComplete($('input[name=$name]'), '$url', 'Pilih Data', null);
						
		  			";
			if ($id !=""){
				$str.=" $(\"input[name=$name]\").select2('data',{id:'".$id."', text:'".$text."'});";	
			}	
		  	$str.="</script>";
	return $str;
}

function spasi($rekursive = 1){
    for($a=1 ; $a <= $rekursive ; $a++){
        echo '&nbsp;';
    }
}

function get_client_ip() {
	$ipaddress = '';
        if($_SERVER['REMOTE_ADDR']){
		$ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
		$ipaddress = 'UNKNOWN';
        }

	return $ipaddress;
}

    function formatTanggalPanjang($tanggal) {
        $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        list($thn,$bln,$tgl)=explode("-",$tanggal);
        $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
        return $tgl." ".$aBulan[$bln]." ".$thn;
    }

    function formatBulanTahun($tanggal) {
        $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        list($thn,$bln,$tgl)=explode("-",$tanggal);
        $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
        return $aBulan[$bln]." ".$thn;
    }



function tanggal($date = 1){
    date_default_timezone_set('Asia/Jakarta'); // your reference timezone here
    $date = date('Y-m-d', strtotime($date)); // ubah sesuai format penanggalan standart
    $bulan = array ('01'=>'Januari', // array bulan konversi
            '02'=>'Februari',
            '03'=>'Maret',
            '04'=>'April',
            '05'=>'Mei',
            '06'=>'Juni',
            '07'=>'Juli',
            '08'=>'Agustus',
            '09'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember'
    );
    $date = explode ('-',$date); // ubah string menjadi array dengan paramere '-'

    return @$date[2] . ' ' . @$bulan[$date[1]] . ' ' . @$date[0]; // hasil yang di kembalikan}
}




function romawi($n = '1'){
    $hasil = '';
    $iromawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X',
        20=>'XX',30=>'XXX',40=>'XL',50=>'L',60=>'LX',70=>'LXX',80=>'LXXX',
        90=>'XC',100=>'C',200=>'CC',300=>'CCC',400=>'CD',500=>'D',
        600=>'DC',700=>'DCC',800=>'DCCC',900=>'CM',1000=>'M',
        2000=>'MM',3000=>'MMM');
    
    if(array_key_exists($n,$iromawi)){
        $hasil = $iromawi[$n];
    }elseif($n >= 11 && $n <= 99){
        $i = $n % 10;
        $hasil = $iromawi[$n-$i] . Romawi($n % 10);
    }elseif($n >= 101 && $n <= 999){
        $i = $n % 100;
        $hasil = $iromawi[$n-$i] . Romawi($n % 100);
    }else{
        $i = $n % 1000;
        $hasil = $iromawi[$n-$i] . Romawi($n % 1000);
    }
    return $hasil;
}



function combo_kota($id = 'asa',$selected=""){
    $h = "<select id='$id' name='$id' style='width:100%'>";
    $prov = \DB::table('ms_provinsi')
            ->orderBy('nama','asc')->get();
    foreach($prov as $p){
        $h .= ' <optgroup label="'.$p->nama.'">';
        $kota = \DB::table('ms_kota_kabupaten')->where('provinsi_id','=',$p->id)->orderBy('nama','asc')->get();
        foreach($kota as $k){
            $h .= '<option '.(($selected==$k->id)?' selected ':'').' value="'.$k->id.'">'.$k->nama.'</option>';
        }
        $h .= '</optgroup>';
    }
    $h .= '</select>';
    return $h;
}

function combo_kelurahan($id = 'asa',$selected=""){
    $h = "<select id='$id' name='$id' style='width:100%'>";
    $kota = \DB::table('ms_kota_kabupaten')->orderBy('nama','asc')->get();
    foreach($kota as $k){
        $h .= ' <optgroup label="'.$k->nama.'">';
        $kec = \DB::table('ms_kecamatan')->where('kota_kabupaten_id','=',$k->id)->orderBy('name','asc')->get();
        foreach($kec as $kc){
            $h .= ' <optgroup label="'.$kc->name.'">';
            $kel = \DB::table('ms_desa_kelurahan')->where('kecamatan_id','=',$kc->id)->orderBy('name','asc')->get();
            foreach($kel as $kl){
                $h .= '<option '.(($selected==$kl->id)?' selected ':'').' value="'.$kl->id.'">'.$kl->name.'</option>';
            }
            $h .= '</optgroup>';
        }
        $h .= '</optgroup>';
    }
    $h .= '</select>';
    return $h;
}

function combo_kecamatan($id = 'asa',$selected=""){
    $h = "<select id='$id' name='$id' style='width:100%'>";
    $prov = \DB::table('ms_provinsi')
            ->orderBy('nama','asc')->get();
    foreach($prov as $p){
        $h .= ' <optgroup label="'.$p->nama.'">';
        $kota = \DB::table('ms_kota_kabupaten')->where('provinsi_id','=',$p->id)->orderBy('nama','asc')->get();
        foreach($kota as $k){
            $h .= ' <optgroup label="'.$k->nama.'">';
            $kota = \DB::table('ms_kecamatan')->where('kota_kabupaten_id','=',$k->id)->orderBy('nama','asc')->get();
            foreach($kec as $kc){
                $h .= '<option '.(($selected==$kc->id)?' selected ':'').' value="'.$kc->id.'">'.$kc->name.'</option>';
            }
            $h .= '</optgroup>';
        }
        $h .= '</optgroup>';
    }
    $h .= '</select>';
    return $h;
}


function combo_jnskelamin($id ='',$selected=""){
    $h = "<select id='$id' name='$id' style='width:100%'>";    
    $h .= '<option value="">Pilih Jenis Kelamin</option>';
    $h .= '<option '.(($selected == '1')?'selected':'').' value="1">Laki-laki</option>';
    $h .= '<option '.(($selected == '2')?'selected':'').' value="2">Perempuan</option>';
    $h .= '</select>';
    return $h;
}


function select_hari($id = 0,$selected=''){
    $hari = array("-", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu","All Day");
    return Form::select($id,$hari,$selected,array('style' => 'width:100%'));
}

function array_hari($id = 0,$selected=''){
    $hari = array("-", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu","All Day");
    return $hari;
}

function date_picker($id = 'asa',$value=""){
    echo '<script>'
    .'$(document).ready(function(){'
    .'$(".tgl").datetimepicker({format: "YYYY-MM-DD"});'
    .'})</script>'
    .'<input type="text" class="form-control tgl" value="'.$value.'" id="'.$id.'" name="'.$id.'"  placeholder="Masukkan Tanggal">';
}

function tanggal_indonesia(){
    $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"); 
//    $cetak_date = $hari[(int)date("w")] .', '. date("j ") . $bulan[(int)date('m')] . date(" Y"); 
    $cetak_date = date("j ") . $bulan[(int)date('m')] . date(" Y"); 
    return $cetak_date ;
}

function sekarang(){
    return date("Y-m-d H:i:s");
}


function combo_agama($id = '',$selected = false){
    $a = '<select id="'.$id.'" name="'.$id.'" style="width:100%;">';
    $a .= '<option value="">Pilih Agama</option>';

//    $s1 = ($selected == 'Islam')?' selected ':'';
//    $a .= '<option '.$s1.'value="Islam">Islam</option>';
//    
//    $s1 = ($selected == 'Kristen')?' selected ':'';
//    $a .= '<option '.$s1.'value="Kristen">Kristen</option>';
//    
//    $s1 = ($selected == 'Katolik')?' selected ':'';
//    $a .= '<option '.$s1.'value="Katolik">Katolik</option>';
//    
//    $s1 = ($selected == 'Hindu')?' selected ':'';
//    $a .= '<option '.$s1.'value="Hindu">Hindu</option>';
//    
//    $s1 = ($selected == 'Budha')?' selected ':'';
//    $a .= '<option '.$s1.'value="Budha">Budha</option>';
//    
//    $s1 = ($selected == 'Konghucu')?' selected ':'';
//    $a .= '<option '.$s1.'value="Konghucu">Konghucu</option>';
//    
//    $s1 = ($selected == 'Lainnya')?' selected ':'';
//    $a .= '<option '.$s1.'value="Lainnya">Lainnya</option>';
    
    $agama = \DB::table('ref_agama')->orderBy('kode','asc')->get();
    foreach ($agama as $row) {
        $s = ($selected == $row->id)?'selected="selected"':'';
        $a .= '<option '.$s.'value="'.$row->id.'">'.$row->uraian.'</option>';
    }
    $a .= '</select>';
    return $a;
}

function modal($sempit = false,$name = 'modal2',$body = 'Modal2',$minus=false){
    $class = ($sempit == false)?'modal-dialog-wide':'modal-dialog';
    $js = '<script>var duplicateChk = {};'
            .'$("div#modal2[class]").each (function (a) {'
            .'if (duplicateChk.hasOwnProperty(this.class)) {'
            .'alert("kembar");$(this).remove();'
            .'} else { duplicateChk[this.class] = "true";}});</script>';
    
    $min = ($minus == true)?'':'';
    $html =  '<div class="modal fade" id="'.$name.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="'.$class.'">
        <div class="modal-content" id="wadah_modal">
        <div class="modal-header bg-primary">
        <button onclick="claravel_modal_close('."'$name'".')" type="button" aria-hidden="true" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-remove" ></i></button>
            '.$min.'
        <h4 class="modal-title"><b id="judulmodal"></b></h4>
      </div>
      <div class="modal-body">
        <div id="konten'.$body.'"></div>
      </div>
      <div class="modal-footer">
        <div id="footermodal"></div>
      </div>
    </div>
  </div>
</div>';
	return $html;
}

function catat_log($aksi = '',$modul=''){
    $simpan = array(
        'aksi' => $aksi,
        'module' => $modul,
        'user' => \Session::get('user_id'),
        'url' => \Request::url(),
        'waktu' => date("Y-m-d H:i:s")
    );
    $save = \DB::table('application_log')->insert($simpan);
}
function header_dokumen(){
    return '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap.css" />'.
            '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap-theme.css" />'.
            '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap-icons.css" />';
}
function hari($hari){
    switch ($hari){
        case '0' :
            return '';
            break;
        case '1' :
            return 'Senin';
            break;
        case '2' :
            return 'Selasa';
            break;
        case '3' :
            return 'Rabu';
            break;
        case '4' :
            return 'Kamis';
            break;
        case '5' :
            return "Jum'at";
            break;
        case '6' :
            return 'Sabtu';
            break;
        case '7' :
            return 'Minggu';
            break;
    }
    
}
function konversi_hari($hari){
    $hari = date("l", strtotime($hari));
        switch ($hari){
        case 'Monday' :
            return 'Senin';
            break;
        case 'Thuesday' :
            return 'Selasa';
            break;
        case 'Wednesday' :
            return 'Rabu';
            break;
        case 'Thursday' :
            return 'Kamis';
            break;
        case 'Friday' :
            return "Jum'at";
            break;
        case 'Saturday' :
            return 'Sabtu';
            break;
        case 'Sunday' :
            return 'Minggu';
            break;
    }
};	

  
function cekLogin(){
    $user = \Session::get('user_id');
    $role = \Session::get('role_id');
    return (!$user || !$role)?false:TRUE;
    //if (!$user || !$role){die('Invalid Access :: You must sign in first !!<br><br><i>With Love :: Developer</i>');}
}

function cekAjax(){
    if (!\Request::ajax()){die('Invalid URL Request<br><br><i>With Love :: Developer</i>');}
}





function get_role(){
    return \Session::get('role_id');
}

function get_username(){
    $role = \Session::get('role_id');
    if ($role == '2' || $role == '3' || $role == '4' || $role == '6'){
            $user = explode('-', \Session::get('user_name'));
            $user = $user[1];
            return $user;
    }
}

function inputPeriodeRpjmd($nama="tahun_anggaran",$id="", $text="",$value=false,$selected=false){
	$periode = \PeriodetahunModel::where('kategori', 'RPJMD/RENSTRA')->first();
	$str="<select id='".$id."' style='width:100%;' class='form-control' name='".$nama."' placeholder=\"Pilih Tahun Anggaran\">";
	for($i=$periode->tahun_awal;$i<=$periode->tahun_akhir;$i++){
            $the_value=($value == true)?'value="'.$i.'"':'';
            $the_selected=($selected==$i)?' selected ':' ';
            $str.="<option ".$the_selected.' '.$the_value.">".$i."</option>";
	}
	$str.="</select>";
	echo $str;
}
//START CREATED BY WIGUNA ON 16 MARET

function inputWarna($id='',$nama="",$selected=""){
    $a1 = ($selected == 'bg-color-blue')?' selected ':' ';
    $a2 = ($selected == 'bg-color-blueDark')?' selected ':' ';
    $a3 = ($selected == 'bg-color-darken')?' selected ':' ';
    $a4 = ($selected == 'bg-color-green')?' selected ':' ';
    $a5 = ($selected == 'bg-color-greenDark')?' selected ':' ';
    $a6 = ($selected == 'bg-color-orange')?' selected ':' ';
    $a7 = ($selected == 'bg-color-pink')?' selected ':' ';
    $a8 = ($selected == 'bg-color-purple')?' selected ':' ';
    $a9 = ($selected == 'bg-color-yellow')?' selected ':' ';
    $a10 = ($selected == 'bg-color-red')?' selected ':' ';
    $html = '<select id="'.$id.'" name="'.$nama.'">
            <option '.$a1.'value="bg-color-blue">Biru</option>
            <option '.$a2.'value="bg-color-blueDark">Biru Gelap</option>
            <option '.$a3.'value="bg-color-darken">Gelap</option>
            <option '.$a4.'value="bg-color-green">Hijau</option>
            <option '.$a5.'value="bg-color-greenDark">Hijau Gelap</option>
            <option '.$a6.'value="bg-color-orange">Jingga</option>
            <option '.$a7.'value="bg-color-pink">Merah Muda</option>
            <option '.$a8.'value="bg-color-purple">Ungu</option>
            <option '.$a9.'value="bg-color-red">Merah</option>
            <option '.$a10.'value="bg-color-yellow">Kuning</option>
            </select>';
    return $html;
}


function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

function getBaseURL($with_http = false){
    /*
    $url = \Request::url();
    //    $url = str_replace('http://')
    $arrurl = explode('/',$url);
    if ($with_http == false){
        return $arrurl[2];
    }
    else{
        return (isSecure())?'https://'.$arrurl[2].'/':'http://'.$arrurl[2].'/';
        //return 'https://'.$arrurl[2].'/';
    }
    */
    return url();
}

function detail_tahun(){
    $periode = \PeriodetahunModel::where('kategori', 'RPJMD/RENSTRA')->first();
    $arrtahun =
        array(
            'awal' => $periode->tahun_awal,
            'akhir' => $periode->tahun_akhir
        );
    return $arrtahun;
}

function arrayTahun(){
    $periode = \PeriodetahunModel::where('kategori', 'RPJMD/RENSTRA')->first();
    $str = array();
    for($i=$periode->tahun_awal; $i<=$periode->tahun_akhir; $i++){
        array_push($str ,$i);
    }
    return $str;
}


function maxDuitKelurahan($id_kel = 0,$tahun = false){
    $data = DB::table('s_setting_kelurahan')
        ->select('max_anggaran')->where('id_kel','=',$id_kel)->where('tahun','=',$tahun)
        ->get();
    foreach($data as &$row){
        return $row->max_anggaran;
    }
    //    $data = DB::table('s_setting_batas_max_anggaran')
    //        ->select('max_kelurahan')
    //        ->get();
    //    foreach($data as $row){
    //        return $row->max_kelurahan;
    //    }
}
/*END CEK KELURAHAN*/



function inputPeriodeRpjmd2($nama="tahun_anggaran",$id="", $text="",$value=false,$selected=false){

	$periode = \Modules\Utility\Periodetahun\Models\PeriodetahunModel::where('kategori', 'RPJMD/RENSTRA')->first();
	$str="<select id='".$id."' name='".$nama."' placeholder=\"Pilih Tahun Anggaran\">";
	for($i=$periode->tahun_awal;$i<=$periode->tahun_akhir;$i++){
            $the_value=($value == true)?'value="'.$i.'"':'';
            $a = ($i == $selected)?' selected ':'';
            $str.="<option ".$a.$the_value.">".$i."</option>";
	}
	$str.="</select>";
	echo $str;
}
//END CREATED BY WIGUNA ON 16 MARET

function combo_idj($id = '',$selected = false){
    $a = '<select id="'.$id.'" name="'.$id.'" style="width:100%;" class="form-control">';
    $a .= '<option value="">Pilih ID Jadwal</option>';
    
    $idj = \DB::table('tr_jadwal_aktif')->orderBy('id','asc')->get();
    foreach ($idj as $row) {
        $s = ($selected == $row->id)?'selected="selected"':'';
        $a .= '<option '.$s.'value="'.$row->id.'">'.$row->id.'</option>';
    }
    $a .= '</select>';
    return $a;
}