<?php
//最初の処理
setlocale(LC_ALL, 'ja_JP');
date_default_timezone_set('Asia/Tokyo');
$adm = False;
$kind = array("個人練", "バンド練", "使用不可");
$honi = new Honi();
$youbi = array("日", "月", "火", "水", "木", "金", "土");
$muko = "";
$sentaku = "";

$res = [];

$paha = password_hash("ame1970myu", PASSWORD_DEFAULT);

$hidu = $honi->defaCal();

$yLis = [];
$mLis = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

//$datab = new mysqli('mysql1.php.xdomain.ne.jp', 'kotareaux_view', 'H2EAh3Md9qLDmAa', 'kotareaux_reserverenshia');
try{
	$datab = new PDO('sqlite:reserverenshia');
} catch (PDOException $e){
    die("データベースへの接続に失敗しました:" . $e->getMessage() . "\n");
}

class Honi{
		
	function fetch_all(& $stmt) {
		$hits = array();
		$params = array();
		$meta = $stmt->result_metadata();
		while ($field = $meta->fetch_field()) {
			$params[] = &$row[$field->name];
		}
		call_user_func_array(array($stmt, 'bind_result'), $params);
		while ($stmt->fetch()) {
			$c = array();
			foreach($row as $key => $val) {
				$c[$key] = $val;
			}
		$hits[] = $c;
		}
		return $hits;
	}
	
	function viewRsv($a, $b, $tbid, $resinfo, $adm){
		global $kind, $muko, $datab;
		$kekka = [];
		$nn = "";
		$nnn = "";
		$query = "SELECT * FROM `".$tbid."` WHERE date = ? and time = ?";
		if ($stmt = $datab->prepare($query)){
			$stmt->bind_param("ss", $a, $b);
			$stmt->execute();
			$stmt->bind_result($d, $t, $ba, $n, $bi);
			$stmt->store_result();
			$stmt->fetch();
			
			if (!$stmt->num_rows){
				//予約が入っていない
				if($adm){
					$n = Null;
				}else{
					$n = "<button type=submit class='rbtn' name='res' value='{$resinfo}' {$muko}>予約</button>";
				}
				$nn = "<button type=submit class='rbtn' name='res' value='{$resinfo}' {$muko}>使用不可にする</button>";
			}else{
				if ($ba == 2){
					//無効
					$n = "使用不可";
				}else{
					$n = $this->hsc($n)."／".$kind[$ba];
				}
				$nn = "<button type=submit class='rbtn' name='res' value='{$resinfo}' {$muko}>削除</button>";
			}
			if($adm){
				return [$n, $bi, "<td>".$nn."</td>"];
			}else{
				return [$n, $bi, Null];
			}
		
		}else{
			die("予約情報取得失敗: データベースに接続できません");
		}
		
	}
	
	function cyList(){
		global $datab;
		$kekka = [];
		$query = "SELECT * FROM `activetab` ORDER BY `yyyy` DESC;";
		
		if ($result = $datab->query($query)) {
			while ($row = $result->fetchAll(PDO::FETCH_COLUMN)){
				array_push($kekka, $row[0]);
			}
			return array_unique($kekka);
		}else{
			die("予約表リスト取得失敗: データベースに接続できません");
		}
	}
	
	function odatList($hidu, $dLis, $num){
		$tmparr = ["year", "month"];
		echo "<select name='".$tmparr[$num]."'>";
		foreach ($dLis as $row){
			if ($hidu[$num] == $row){
				$sentaku = "selected";
			}else{
				$sentaku = "";
			}
			echo "<option value='".$row."' ".$sentaku.">".$row."</option>";
		}
		echo "</select>";
		return;
	}
	
	function getaTime($tbid){
		global $datab;
		$kekka = [];
		$query = "SELECT * FROM `availabletime` WHERE targettable = ?";
		if($stmt = $datab->prepare($query)){
			$stmt->bind_param("s", $tbid);
			$stmt->execute();
			$stmt->store_result();
			$alresu = $this->fetch_all($stmt);
			//ここから多次元配列にする(曜日で指定できるように)
			if (!$stmt->num_rows){
				die("使用可能時間取得失敗: データが存在しない可能性があります");
			}
			foreach ($alresu as $row){
				$kekka[$row["dayid"]][$row["timeid"]] = $row;
			}
			return $kekka;
		}else{
			die("使用可能時間取得失敗: データベースに接続できません");
		}
	}
	
	function aruTab($hidu){
		global $datab;
		$query = 'SELECT count(*) FROM activetab WHERE yyyy = ? and mm = ?';
		if($stmt = $datab->prepare($query)){
			//$stmt->bind_param("ss", $hidu[0], $hidu[1]);
			$stmt->bindValue(1, $hidu[0]);
			$stmt->bindValue(2, $hidu[1]);
			$stmt->execute();
			echo $stmt->fetchColumn();
			echo "<Pre>";
			var_dump($hidu);
			var_dump($stmt);
			echo "</pre>";
			
			
			if (1==0){
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	
	function showCal($hidu, $adm){
		global $muko, $youbi;
		$tbid = $hidu[0]."_".$hidu[1];
		$day_count = date('t', strtotime($hidu[0].'-'.$hidu[1]));

		if($this->aruTab($hidu)){
			$tdat = $this->getaTime($tbid);
			if($adm){
				echo "<form action='edit.php' method='post'>";
			}else{
				echo "<form action='reserve.php' method='post'>";
			}
			echo "<table class='rhyo'>";
			echo "<tr><th>日付</th><th>時間帯</th><th class='tyo'>予約者／種類</th>";
			if ($adm){
				echo "<th class='tyo'>編集</th>";
			}
			echo "<th class='tbi'>備考</th></tr>";
			for ($i = 1; $i <= $day_count; $i++){
				
				$yo = date('w', mktime(0, 0, 0, $hidu[1], $i, $hidu[0]));
				
				for ($j = 0; $j < count($tdat[$yo]); $j++){
					
					if ($j == 0){
						$line = "<td class='hi' rowspan='".count($tdat[$yo])."'>{$i}({$youbi[$yo]})</td>";
					}else{
						$line = "";
					}
				
					if ($yo == 0){
						$style = " class='sun'";
					}elseif($yo == 6){
						$style = " class='sat'";
					}else{
						$style = " class='wkd'";
					}
				
					$rresinfo = ['year'=>$hidu[0],
								'month'=>$hidu[1],
								'day'=>$i,
								'youbi'=>$youbi[$yo],
								'time'=>$tdat[$yo][$j]["timename"],
								'timeid'=>$tdat[$yo][$j]["timeid"]
								];
					$resinfo = json_encode($rresinfo, JSON_UNESCAPED_UNICODE);
				
					$crsv = $this->viewRsv($i, $j, $tbid, $resinfo, $adm);
				
					echo <<< EOM
					<tr{$style}>{$line}
					<td>{$this->hsc($tdat[$yo][$j]['timename'])}</td>
					<td class='trna'>{$crsv[0]}</td>
					{$crsv[2]}
					<td class='trbi'>{$this->hsc($crsv[1])}</td>
					</tr>
EOM;
				}
			}//fori

		echo "</table></form>";
		}else{ //ifaltab
			die("準備中、あるいは予約表データが存在しません");
		}
	}
	
	function defaCal(){
		return ["2021", "6"];
	}
	
	function hsc($moji){
		return htmlspecialchars($moji);
	}
	
}

?>