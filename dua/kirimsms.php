<form method="post">
<label>No HP Format +62xxxxxxx </label>
<input type="text" name="nohp">
<label>Pesan</label>
<input type="text" name="pesan">
<input type="date" name="date">
<input type="submit" name="button" value="Kirim">
</form>
<?php
if(isset($_POST['button']))
{
    mysql_connect("localhost","root","");
    mysql_select_db("gammu"); 
    $query=mysql_query("INSERT INTO outbox (DestinationNumber,
    TextDecoded, SendingDateTime) VALUES ('".$_POST['nohp']."', '".$_POST['pesan']."', '".$_POST['date']."')");
    if($query)
    {
        echo "<script>alert('Sukses kirim sms')</script>";
    }
}
?>