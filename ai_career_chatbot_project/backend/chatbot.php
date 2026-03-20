
<?php
$msg = $_POST['message'] ?? '';

if(stripos($msg,'cse')!==false){
  echo "CSE Career: Software Engineer, Web Developer, Data Scientist.";
}
elseif(stripos($msg,'bba')!==false){
  echo "BBA Career: Marketing, HR, Accounting, Management.";
}
elseif(stripos($msg,'diploma')!==false){
  echo "Diploma Career: Electrical, Mechanical, Civil, Computer.";
}
else{
  echo "Please tell me your education level and interest (CSE, BBA, Diploma, Skills).";
}
?>
