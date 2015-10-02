<?php
class CreateTableDemo{
	const DB_HOST = 'localhost';
	const DB_NAME = 'TESTING';
	const DB_USER = 'root';
	const DB_PASSWORD = "your_password'";

	private $conn = null;
        public function __construct(){
		// open database connection
		$connectionString = sprintf("mysql:host=%s;dbname=%s",
				CreateTableDemo::DB_HOST,
				CreateTableDemo::DB_NAME);
		try {
			$this->conn = new PDO($connectionString,
					CreateTableDemo::DB_USER,
					CreateTableDemo::DB_PASSWORD);

		} catch (PDOException $pe) {
			die($pe->getMessage());
		}
	}
public function createTaskTable() {
		$sql = <<<EOSQL
CREATE TABLE IF NOT EXISTS table_name (
	task_id int(11) NOT NULL AUTO_INCREMENT,
	subject varchar(255) DEFAULT NULL,
	start_date date DEFAULT NULL,
	end_date date DEFAULT NULL,
	description varchar(400) DEFAULT NULL,
	PRIMARY KEY (task_id)
);
EOSQL;
		if($this->conn->exec($sql) !== false)
			return true;
		return false;
	}
        
public function retrieveData($query)
{
    $res=$this->conn->query($query);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    while($row=$res->fetch())
    {
        echo $row;
    }
//  Prepare Statement Version
//    $q = $conn->prepare($sql);
//    $q->execute(array(':fname' => 'Le%',
//                      ':lname' => '%son'));
//    $q->setFetchMode(PDO::FETCH_ASSOC);
// 
//    while ($r = $q->fetch()) {
//    echo sprintf('%s <br/>', $r['lastname']); }       
}
public function insertPrimitive()
{
  $sql = "INSERT INTO tasks(subject,description,start_date,end_date)
 VALUES('Learn PHP MySQL Insert Dat', 'PHP MySQL Insert data into a table','2013-01-01','2013-01-01')";
    $this->conn->exec($sql);
    
}
public function insertPDO($subject,$description,$startdate,$enddate)
{
   $task = array(':subject' => $subject,
 ':description' => $description,
 ':start_date' => $startdate,
 ':end_date' => $enddate);
   $sql = 'INSERT INTO tasks(subject,description,start_date,end_date)
 VALUES(:subject,:description,:start_date,:end_date)';
   $query=$this->conn->prepare($sql);
   $query->execute($task);
    
}
 public function delete($subject) {
 
 $sql = 'DELETE FROM tasks
 WHERE subject = :Subject';
 
 $q = $this->conn->prepare($sql);
 
 return $q->execute(array(':Subject' => $subject));
 }
 public function update($id,$subject,$description,$startDate,$endDate) {
 $task = array( ':taskid' => $id,
 ':subject' => $subject,
 ':description' => $description,
 ':start_date' => $startDate,
 ':end_date' => $endDate);
 
 $sql = 'UPDATE tasks
 SET subject = :subject,
     start_date = :start_date,
     end_date = :end_date,
     description = :description
 WHERE task_id = :taskid';
 
 $q = $this->conn->prepare($sql);
 
 return $q->execute($task);
 }
public function __destruct() {
		// close the database connection
		$this->conn = null;
	}
}
?>