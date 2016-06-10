
<?php
	if( isset($_POST['number']) ) {
		$number = $_POST['number'];
		$fp = @fopen('csdl.txt', "a+") ;
		fwrite($fp, $number . "\n") ;
		fclose($fp) ;
		$url = "https://www.google.com.vn/";
		$headers = @get_headers($url);
		if(strpos($headers[0],'200') === false)
		{
		  	$fp = @fopen('prdata.txt', "a+") ;
			fwrite($fp, $number . "\n") ;
			fclose($fp) ;
			die;
		}
		else
		{
			$fp = @fopen('prdata.txt', "a+") ;
			fwrite($fp, $number . "\n") ;
			fclose($fp) ;
			$fp = @fopen('prdata.txt', "a+") ;
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "phpk13";
			$conn = new mysqli($servername,$username,$password,$dbname);
			if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }	
			while(!feof($fp))
			{
				$data = fgets($fp) ;
				if($data!="")
				{
					$sql = "INSERT INTO datamanv (MaNV) value ('$data')" ;
					if ($conn->query($sql) === TRUE) {}
				}
			}
			fclose($fp) ;	
			$conn->close();
			unlink('prdata.txt');
			die;
		}
/*
		$number = $_POST['number'];
		file_put_contents('csdl.txt', $number);
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "phpk13";
		$conn = new mysqli($servername,$username,$password,$dbname);
		if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
		$sql = "INSERT INTO datamanv (MaNV) value ('$number')" ;
		if ($conn->query($sql) === TRUE) {}
		$conn->close();
		die;
*/
	}
?>
