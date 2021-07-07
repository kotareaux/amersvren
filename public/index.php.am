<?php
require "fiva.php";
?>
<meta name="viewport" content="target-densitydpi=device-dpi,width=600px,maximum-scale=1.0,user-scalable=yes" />
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
<title>アメミュ練習室予約システム</title>
<div class="oya">
<header>
<span class="nama">アメミュ練習室予約システム</span>
<!-- span class="slbtn"><a href="config/login.php"><button class='yhhb'>Login</button></a></span -->
</header>
<div class="boya">
<?PHP
$adm = False;
//日付かえるところ
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$hidu = array(htmlspecialchars($_POST['year']), htmlspecialchars($_POST['month']));
}else{
	//$hidu = $honi->defaCal();
}

$yLis = $honi->cyList();

echo "<div class='htle'>".$hidu[0]."年".$hidu[1]."月の予約表</div>\n";
echo <<< EOM
<input id="acd-check1" class="acd-check" type="checkbox">
<label class="acd-label" for="acd-check1">練習室使用可能時間・場所（クリックで開閉）</label>
<div class="acd-content">
月〜金 17：00&#12316;21：00 第7練<br>
土曜日 12：00&#12316;17：00 第10練C<br>
　　　 17：00&#12316;21：00 第6練<br>
日曜日  9：00&#12316;19：00 第6練<br>
</div>
EOM;
echo "<div class='hhlsk'><form action='' method='post'>";
echo "表示する表を変更：";
$honi->odatList($hidu, $yLis, 0);
echo "年";
$honi->odatList($hidu, $mLis, 1);
echo "月\n";
echo "<button type='submit' class='yhhb'>選択</button>";
echo "</form></div>\n";

//かれんだーひょうじ
$honi->showCal($hidu, $adm);

$datab = null;
?>


</div></div>

<?php
/*
$db = new PDO('sqlite:reserverenshia');

//$sql = <<exec($sql);

$insert = $db->prepare('INSERT INTO "2021_5" (date, time) VALUES (?, ?)');
$stmt = $insert->execute([1,0]);
$stmt = $insert->execute([1,1]);

$syohin = $db->prepare('SELECT * FROM "2021_5"');
$syohin->execute();
$result = $syohin->fetchAll(PDO::FETCH_ASSOC);
print_r($result);
*/
?>