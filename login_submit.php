<?php


/* funckija za prijavu korisnika i provjeru prijave preko php-a*/
require('connection.inc.php');
require('functions.inc.php');


/* korisimo dvije variajble, email i lozinku */
$email=get_safe_value($con,$_POST['email']);
$password=get_safe_value($con,$_POST['password']);


/* selektuje sve mejlove i lozinke iz baze. ako se podudaraju sa korisnikovim inputom, onda ima dozvolu da se uloguje */
$res=mysqli_query($con,"select * from users where email='$email' and password='$password'");
$check_user=mysqli_num_rows($res);
if($check_user>0){
	$row=mysqli_fetch_assoc($res);
	$_SESSION['USER_LOGIN']='yes';
	$_SESSION['USER_ID']=$row['id'];
	$_SESSION['USER_NAME']=$row['name'];
	echo "valid";
}else{
	/* u suprotnom ne moze se ulogovati */
	echo "Greska. Ne moze se logovati";
}
?>