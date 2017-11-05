
<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>id</th><th>fname</th><th>lname</th><th>email</th><th>phone</th><th>birthday</th><th>gender</th><th>password</th> </tr>";

class TableRows extends RecursiveIteratorIterator { 
    function  __construct($result) { 
      parent::__construct($result, self::LEAVES_ONLY); 
      }

   function current() {
 return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
			        }

function beginChildren() { 
 echo "<tr>"; 
} 

  function endChildren() { 
 echo "</tr>" .  "\n";
 } 
} 
$dbs = 'mysql:dbname=sp2372;host=sql1.njit.edu';
$user = 'sp2372';
$password = 'EUGtORiY';
   
    
 try {
    $dbh = new PDO($dbs,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'connected successfully'; 
    echo '<br>';
     $stmt = $dbh->prepare("SELECT * FROM accounts WHERE id<6");
      $stmt->execute();
     

 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
         echo $v;
	}
	

	
      } catch(PDOException $e) {  
         echo "Error: " .$e->getMessage();
	 }
	 $row_count =  $stmt->rowCount();
	 echo $row_count;
     $dbh = null;
     echo "</table>";
?>

