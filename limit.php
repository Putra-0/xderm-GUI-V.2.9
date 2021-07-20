<?php
 exec("ls login.php|awk 'NR==1'|awk -F '.' '{print $1}'",$clo);
  if ($clo[0]) {
include 'header.php';
ceklogin();
  };
 exec("cat limitdir/st",$sst);
  if (!$sst[0]) {
   exec('echo Start > limitdir/st');
  };
 exec("cat limitdir/sz",$ssz);
  if (!$ssz[0]) {
   exec('echo 3 > limitdir/sz');
  };
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="img/fav.ico">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="css/style.css">
<meta charset="UTF-8"><title>Xderm Limitation</title>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: "limitdir/log.txt",
		cache: false,
                success: function(result) {
		    $("#log").html(result);
                }
            });
        $(document).ready(function() {
                $.ajaxSetup({ cache: false });
                        });
                var textarea = document.getElementById("log");
                textarea.scrollTop = textarea.scrollHeight;
        }, 1000);
    });
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<body style="text-align:center">
<div class="block moving-glow">
<center>
<a href="login.php" onClick="logout()">
<img src="img/images.png" width: 80%></a>
</center>
       <form method="post">
<center><table align="center"><tr><td class="col-butt">
<button type="submit" name="button1" class="glow-on-hover" id="strp"
        value="<?php echo exec('cat limitdir/st') ?>"/>
	<?php echo exec('cat limitdir/st') ?></button>
<button type="submit" name="button2" class="glow-on-hover" id="config"
        value="Config"/>Config</button>
</td></tr></center>
</table><br>
</form>
<?php
  if (isset($_POST['button1'])) {
  exec('cat limitdir/st',$o);
if ( $o[0] == 'Start' ) {
 exec('killall -q limit');
 exec('chmod +x limit');
 exec('screen -d -m ./limit');
 exec('echo Stop > limitdir/st');
echo '<script>
  document.getElementById("strp").value="Stop";
</script>';
 } else {
 exec('killall -q limit');
 exec('echo "Auto Limit Client Stopped." > limitdir/log.txt');
 exec('tc qdisc del dev eth0 root handle 1: > /dev/null 2>&1');
 exec('echo Start > limitdir/st');
echo '<script>
  document.getElementById("strp").value="Start";
</script>';
}
  }
?>
<table align="center"><tr><td class="box_script"><div class="inline-block"><pre>
<?php
 if (isset($_POST['simpan'])) {
 $ipl=$_POST['iplist'];
 $sz=$_POST['size'];
 $use_ip=$_POST['use_ip'];
 if ($use_ip <> 'yes' ){$use_ip='no';}
 exec("echo \"$sz\" > limitdir/sz");
 exec("echo \"$ipl\" > limitdir/ip.list");
 exec('echo -e "use_ip='.$use_ip.'" > limitdir/useip');
 exec("echo 'Berhasil Setup, Silahkan Start!' > limitdir/log.txt");
 exec('sed -i \'s/\r$//g\' limitdir/ip.list');
 exec('sed -i \':a;N;$!ba;s/\n\r//g\' limitdir/ip.list');
 exec('sed -i \':a;N;$!ba;s/\n\n//g\' limitdir/ip.list');
};
if($_POST['button2']){
exec("cat limitdir/sz|sed 's/ //g'",$ada);
$ada=$ada[0];
if ($ada) {
$sz = file_get_contents("limitdir/sz");
};
exec('mkdir -p limitdir');
exec('touch limitdir/ip.list');
$data = file_get_contents("limitdir/ip.list");
echo "<h4><b>IP Pengecualian: </b></h4>";
echo "<textarea name='iplist' id='isi' placeholder='Masukkan IP Pengecualian, Contoh:\n192.168.1.1\n192.168.1.99\n192.168.1.21' rows='6' cols='46'>$data</textarea>";
echo '<div class="form-box">';
echo "<b>Speed: <input type='text' name='size' size='1' value=\"$sz\"/>mbps</b> ";
exec("cat limitdir/useip|awk -F '=' '{print $2}'",$useip);
if ( $useip[0] == "yes"){
echo "<input type='checkbox' name='use_ip' value='yes' Checked>ip_pngcl ";
} else {
echo "<input type='checkbox' name='use_ip' value='yes' >ip_pengec ";
};
echo '<input type="submit" name="batal" class="glow-on-hover" value="Batal"/>';
echo '<input type="submit" name="simpan" class="glow-on-hover" value="Simpan"/></form></div>';
} else {
echo '<div id="log" class="scroll"></div></pre></div>';
};
?>
</td></tr>
</table></head><center><div class="nganu slide">Auto Limit Bandwidth xderm<br>© Design by ADI-PUTRA</div></center></div>

</div>
</html>
