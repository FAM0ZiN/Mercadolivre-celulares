<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if (isset($_POST)) 
	{
		if (isset($_POST['cc'])) 
		{
			if ($_POST['cc'] == 0) 
			{
				query("UPDATE config SET cc = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['cc'] == 1) {
				query("UPDATE config SET cc = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['cc_debit'])) {
			if ($_POST['cc_debit'] == 0) 
			{
				query("UPDATE config SET cc_debit = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['cc_debit'] == 1) {
				query("UPDATE config SET cc_debit = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['boleto'])) {
			if ($_POST['boleto'] == 0) 
			{
				query("UPDATE config SET boleto = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['boleto'] == 1) {
				query("UPDATE config SET boleto = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['api'])) {
			if ($_POST['api'] == 0) 
			{
				query("UPDATE config SET api = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['api'] == 1) {
				query("UPDATE config SET api = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['ssl'])) {
			if ($_POST['ssl'] == 0) 
			{
				query("UPDATE config SET usando_ssl = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['ssl'] == 1) {
				query("UPDATE config SET usando_ssl = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['senha'])) {
			if ($_POST['senha'] == 0) 
			{
				query("UPDATE config SET senha_cc = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['senha'] == 1) {
				query("UPDATE config SET senha_cc = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['antiboot'])) {
			if ($_POST['antiboot'] == 0) 
			{
				query("UPDATE config SET antiboot = 1");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}elseif ($_POST['antiboot'] == 1) {
				query("UPDATE config SET antiboot = 0");
				echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
			}
		}elseif (isset($_POST['desconto'])) {
			query("UPDATE config SET desconto = '".$_POST['desconto']."'");
			echo "<script>window.location='index.php?adminunlocked&page=config'</script>";
		}
	}

?>