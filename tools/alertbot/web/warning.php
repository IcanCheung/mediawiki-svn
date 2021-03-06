<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Wikipedia emergency problem report</title>
<script type="text/javascript" language="javascript">
function chkother() {
	if(document.getElementById("other").selected || document.getElementById("parts").selected) {
		document.getElementById('other-fe').style.visibility='visible';
	} else {
		document.getElementById('other-fe').style.visibility='hidden';
	}
}
function chklang() {
	if(document.getElementById("bugzilla").selected || document.getElementById("com").selected) {
		document.getElementById('lang').style.visibility='hidden';
	} else {
		document.getElementById('lang').style.visibility='visible';
	}
}
</script>
<?PHP
require("data.inc.php");
require("config.php");
?>
</head>

<body>
<?
require("../l18n/l18n-init.php");
?>
<form action="addwarn.php" method="post">
	<ol>
		<li><?=gettext("Is your problem related to a Wikimedia project being unreachable or broken?<br />
		If not, please think of filing a bug at <a href=\"http://bugzilla.wikimedia.org\">Bugzilla</a> instead.");?></li>

		<li><?=gettext("Have you understood this script is <em>only</em> for emergencies?");?></li>

		<li><?=gettext("<strong>Is your problem listed on the list at the page end?");?></strong></li>

		<li><?=gettext("On which project did you encounter the problem?");?><br />
			<select name="project" onchange="chklang();">
			<?PHP
			foreach($acceptable_projects as $key=>$desc)
				echo "<option value='$key' id='$key'>$desc</option>\n";
			?>
			</select></li>

		<div id="lang"><li><?=gettext("What language version of the project is it?<br />Please fill in the language code (de, en, etc.)");?><br />
			<input type="text" size="5" maxlength="10" name="language"/></li></div>
			
		<li><?=gettext("What is your problem? Choose:");?>
			<select name="problem" onchange="chkother();">
			<?PHP
			foreach($acceptable_problems as $key=>$desc)
				echo "<option value='$key' id='$key'>$desc</option>\n";
			?>
			</select><div id="other-fe" style="visibility:hidden;">
			<input type="text" name="problem-other" maxlength="100" size="100" value=""/></div></li>

		<li><?=gettext("Who is affected?");?>
			<select name="affected" >
			<?PHP
			foreach($acceptable_levels as $key=>$desc)
				echo "<option value='$key' id='$key'>$desc</option>\n";
			?>
			</select></li>

		<li><?=gettext("Submit your problem report:");?> <input type="submit" value="<?=gettext("Submit problem");?>" /><br />
		<small><?=gettext("Your IP address will be recorded to prevent abuse.");?></small></li>
	</ol>
</form>

Current problems:
<table><tr><th>ID</th><th>Time</th><th>Problem</th><th>Status</th></tr>
<?PHP
	
	$res=mysqli_query($mysql_link,"SELECT * FROM alerts WHERE state = 0 OR state= 1 OR state= 2 ORDER BY time");
	
	if(mysqli_num_rows($res)>0) {
		while($warn=mysqli_fetch_assoc($res)) {
			echo "<tr><td>".$warn["id"]."</td><td>".$warn["time"]."</td><td>".$warn["problem"]."</td><td>".$states[$warn["state"]]."</td></tr>";
		}
	} else {
		echo "<tr><td colspan=\"4\">No current problems known to the Emergency tracker.</td></tr>";
	}
?>
</table>
<script type="text/javascript" language="javascript">
document.getElementById("wp").selected=true;
document.getElementById("dontknow").selected=true;
</script>
</body>
</html>
