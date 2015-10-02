<?php
include './ConnectToDatabase.php';
$try=new CreateTableDemo();
if($try->createTaskTable())
{
    echo 'Table Created Succesfully.';
}
 else {
 
        echo 'Error Occured.';
 }
 $try->insertPrimitive();
 $try->retrieveData("select * from table_name;");
 $try->insertPDO("My Subject", "How do you feel it?", "startdate", "enddate");
 if($try->delete("Learn PHP MySQL Insert Dat"))
 {
     echo 'Deleted Succesfully!.';
 }
 if($try->update(5, "My Subject", "How dob you feel it?", "startdate", "enddate"))
 {
     echo'Updated Succesfully!';
 }
?>