<?php 
mysql_connect("localhost","root","");

mysql_select_db("gammu");

$query = "SELECT * FROM inbox WHERE Processed = 'false'";
$hasil = mysql_query($query);
while($data= mysql_fetch_array($hasil)){
    $id = $data['ID'];
    $noPengirim = $data['SenderNumber'];
    $msg = strtoupper($data['TextDecoded']);
    $pecah = explode("#",$msg);
    $d_tgl=$pecah[1];
    $d_nama=$pecah[2];
    $d_jk=$pecah[3];
    $d_alamat=$pecah[4];
    if($pecah[0]=="REG")
    {
        if($pecah[1] !="" and $pecah[2] !="" and $pecah[3] !="")
        {
            $today = date("Ymd");
            $tgl=date("d M Y");
            $newDate = date("Y-m-d", strtotime($d_tgl));

            $isinyo="Nomor ".$noPengirim." Nama ".$d_nama." JenisKel ".$d_jk." Alamat ".$d_alamat;
            $query=mysql_query("INSERT INTO outbox (DestinationNumber,
            TextDecoded) VALUES ('".$noPengirim."', '".$isinyo."')");      

        }else{
            $query=mysql_query("INSERT INTO outbox (DestinationNumber,
            TextDecoded, CreatorID) VALUES ('".$noPengirim."', 'Gagal Registrasi. Format : REG#Tanggal#Nama#PRIA/WANITA#Alamat')");
        }
    }else{
            $query=mysql_query("INSERT INTO outbox (DestinationNumber,
            TextDecoded) VALUES ('".$noPengirim."', 'Gagal Registrasi. Format : REG#Tanggal#Nama#PRIA/WANITA#Alamat')");
    }
    $query3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
        mysql_query($query3);
}
?>