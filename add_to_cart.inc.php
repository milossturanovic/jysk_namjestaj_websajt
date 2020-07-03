

<!-- Metoda koja dodaje predmete u korpu -->

<?php
class add_to_cart{

	/* Dodavanje  predmeta u korppu */
	function addProduct($pid,$qty){
		$_SESSION['cart'][$pid]['qty']=$qty;
	}


	/* Azuriranje korpe, tipa dodavanje istog predmeta vise puta */
	function updateProduct($pid,$qty){
		if(isset($_SESSION['cart'][$pid])){
			$_SESSION['cart'][$pid]['qty']=$qty;
		}
	}
	
	/* uklanjanje predmeta iz korpa */
	function removeProduct($pid){
		if(isset($_SESSION['cart'][$pid])){
			unset($_SESSION['cart'][$pid]);
		}
	}
	

	/* definisanje stanja prazne korpe */
	function emptyProduct(){
		unset($_SESSION['cart']);
	}
	

	/* broj ukupnih predmeta u korpi */
	function totalProduct(){
		if(isset($_SESSION['cart'])){
			return count($_SESSION['cart']);
		}else{
			return 0;
		}
		
	}

}
?>