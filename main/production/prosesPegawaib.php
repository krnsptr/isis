<?php
/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */
function lastWord($sentence) {
// Break the sentence into its component words:
$words = explode(' ', $sentence);
// Get the last word and trim any punctuation:
$result = trim($words[count($words) - 1], '.?![](){}*');
// Return a result:
return $result;
}

date_default_timezone_set("Asia/Jakarta");
session_start();
  error_reporting(0);
  include '../../library/koneksi.php';
  $date = date("d-M-Y His");

  $temp = explode(".", $_FILES["pegawaib"]["name"]);
	$newfilename = "DataPegawaiB - update  ".$date.' by '.$_SESSION['admin'].'.'. end($temp);
move_uploaded_file($_FILES["pegawaib"]["tmp_name"], "excelpegawaib/" . $newfilename);
	$Filepath="excelpegawaib/".$newfilename;
	 	// Excel reader from http://code.google.com/p/php-excel-reader/
	require('php-excel-reader/excel_reader2.php');
	require('SpreadsheetReader.php');
$sql="START TRANSACTION;";
		$sql.="truncate table pegawaib;";
	try
	{
		
  		$Spreadsheet = new SpreadsheetReader($Filepath);
		$Sheets = $Spreadsheet -> Sheets();
		foreach ($Sheets as $Index => $Name)
		{

			$Time = microtime(true);

			$Spreadsheet -> ChangeSheet($Index);

			foreach ($Spreadsheet as $Key => $Row)

			{
				$npp=$Row[0];
				if(strlen($npp)==4){
					$npp="0".$npp;
				}
				
				$nama=mysqli_escape_string($DBcon,$Row[1]);
				$jk=$Row[2];
				$grade=$Row[3];
				$subgrade=$Row[5];
				$jobname=$Row[6];
				$unitkerja=$Row[7];
				$status=$Row[8];
				$tanggungan=$Row[9];
				

				if($Key>1){
					$sql.="insert into pegawaib values('$npp','$nama','$jk','$grade','$subgrade','$jobname','$unitkerja','$status','$tanggungan');";
				}
				
			}
		
	}}
	catch (Exception $E)
	{
		echo $E -> getMessage();
		// header('location:pegawai.php?status=FALSE');
	}

	$updater=$_SESSION['admin'];
 	$sql.="COMMIT;";
 	  // echo $sql."<br><br><br><br>";
 	// echo $Filepath;

	mysqli_query($DBcon,"insert into pegawaib_log values('','$updater',NOW());");
 	if ($DBcon->multi_query($sql) === TRUE) {
     $DBcon->close();

     header('location:pegawaib.php?status=TRUE');
 } else {
     echo "Error: " . $sql . "<br>" . $DBcon->error;
 }


?>