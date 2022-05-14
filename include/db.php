<? 
	$yul=mysql_connect("localhost", "root", "") or die("Serverda xatolik MB bilan aoqa yo'q");
	mysql_select_db("202", $yul) or die("MB da xatolik");
	function filter($s){
		return trim(htmlspecialchars(str_replace("'", "\'", $s)));
	}

?>