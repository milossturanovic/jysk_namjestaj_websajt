<?php
// Metoda provjere preko PHP-a za registrovanje novog korisnika


require('connection.inc.php');
require('functions.inc.php');

//selektujemo sve inpute vezane za registraciju
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$password=get_safe_value($con,$_POST['password']);


//provjera da li mejl sa kojim korisnik hoce da se registruje vec postoji u bazu.

//trazimo da li taj mejl postoji
$check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));

//ako postoji, izbaci objavu
if($check_user>0){
	echo "Email vec postoji";
	
// ako ne postoji, onda se  email salje u bazu
}else{
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into users(name,email,mobile,password,added_on) values('$name','$email','$mobile','$password','$added_on')");
	echo "insert";
}
?>