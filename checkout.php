<?php 
require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}

$cart_total=0;


/* selektujemo funkcije za checkout */
if(isset($_POST['submit'])){
	$address=get_safe_value($con,$_POST['address']);
	$city=get_safe_value($con,$_POST['city']);
	$pincode=get_safe_value($con,$_POST['pincode']);
	$payment_type=get_safe_value($con,$_POST['payment_type']);
	$user_id=$_SESSION['USER_ID'];
	foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($price*$qty);
		
	}
	$total_price=$cart_total;
	$payment_status='pending';
	if($payment_type=='cod'){
		$payment_status='success';
	}
	$order_status='pending';
	$added_on=date('Y-m-d h:i:s');
	
	

	/* Ubacujemo u tabelu 'order' sve informacije o korisniku koji je kupio neki predmet */
	mysqli_query($con,"insert into `order`(user_id,address,city,pincode,payment_type,payment_status,order_status,added_on,total_price) values('$user_id','$address','$city','$pincode','$payment_type','$payment_status','$order_status','$added_on','$total_price')");
	
	$order_id=mysqli_insert_id($con);
	
	foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val['qty'];
		
		mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
	}
	
	/* Kopra se ponovo stavlja na nulu */
	unset($_SESSION['cart'])
	?>

	<!-- I na kraju se prelazi na stranicu kao potvrda o kupovini -->
	<script>
		window.location.href='thank_you.php';
	</script>
	<?php
	
	
}
?>
       
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    


									<!-- Funkcija koja korisnika vodi na stranicu za prijavu ili registraciju prije nego sto moze da kupi predmet -->
									
									<!-- Ako korisnik nije prijavljen, odradi funkciju -->
									<?php 
									$accordion_class='accordion__title';
									if(!isset($_SESSION['USER_LOGIN'])){
									$accordion_class='accordion__hide';
									?>
									<div class="accordion__title">
                                        Unos podataka
                                    </div>

									<!-- Kolona za prijavu -->
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Prijava</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="login_email" id="login_email" placeholder="Vas mejl*" style="width:100%">
																<span class="field_error" id="login_email_error"></span>
                                                            </div>
															
                                                            <div class="single-input">
                                                                <input type="password" name="login_password" id="login_password" placeholder="Vasa lozinka*" style="width:100%">
																<span class="field_error" id="login_password_error"></span>
                                                            </div>
															
                                                            <p class="require">* Potrebna polja</p>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_login()">Prijava</button>
                                                            </div>
															<div class="form-output login_msg">
																<p class="form-messege field_error"></p>
															</div>
                                                        </form>
                                                    </div>
                                                </div>


												<!-- Kolona za registraciju -->
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Registraija</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="name" id="name" placeholder="Vase ime*" style="width:100%">
																<span class="field_error" id="name_error"></span>
                                                            </div>
															<div class="single-input">
                                                                <input type="text" name="email" id="email" placeholder="Vas mejl*" style="width:100%">
																<span class="field_error" id="email_error"></span>
                                                            </div>
															
                                                            <div class="single-input">
                                                                <input type="text" name="mobile" id="mobile" placeholder="Vas Broj Telefona*" style="width:100%">
																<span class="field_error" id="mobile_error"></span>
                                                            </div>
															<div class="single-input">
                                                                <input type="password" name="password" id="password" placeholder="Vasa lozinka*" style="width:100%">
																<span class="field_error" id="password_error"></span>
                                                            </div>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_register()">REgistruj se</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<!--  Kolone za grad, adresu, zip kod i nacin placanja -->
									<?php } ?>
                                    <div class="<?php echo $accordion_class?>">
                                        Adresa
                                    </div>
									<form method="post">
										<div class="accordion__body">
											<div class="bilinfo">
												
													<div class="row">
														<div class="col-md-12">
															<div class="single-input">
																<input type="text" name="address" placeholder="Adresa" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="single-input">
																<input type="text" name="city" placeholder="Grad" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="single-input">
																<input type="text" name="pincode" placeholder="Postanski broj" required>
															</div>
														</div>
														
													</div>
												
											</div>
										</div>

										<!-- Kolona za nacin placanja -->
										<div class="<?php echo $accordion_class?>">
											nacin placanja
										</div>
										<div class="accordion__body">
											<div class="paymentinfo">
												<div class="single-method">
												Placanje pouzecem <input type="radio" name="payment_type" value="COD" required/>
												</div>
												<div class="single-method">
												  
												</div>
											</div>
										</div>
										 <input type="submit" name="submit"/>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>

					<!-- Lista predmeta sa desne strane -->
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Vasa porudzbina</h5>
                            <div class="order-details__item">

							<!-- ucitavanje svih niformacija o predmetu -->
                                <?php
								$cart_total=0;
								foreach($_SESSION['cart'] as $key=>$val){
								$productArr=get_product($con,'','',$key);
								$pname=$productArr[0]['name'];
								$mrp=$productArr[0]['mrp'];
								$price=$productArr[0]['price'];
								$image=$productArr[0]['image'];
								$qty=$val['qty'];
								$cart_total=$cart_total+($price*$qty);
								?>

								<!-- ucitavanje slike o predmetu -->
								<div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"  />
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname?></a>
                                        <span class="price"><?php echo $price*$qty?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </div>
                                </div>
								<?php } ?>
                            </div>

							<!-- ukupna cijena -->
                            <div class="ordre-details__total">
                                <h5>Ukupna cijena</h5>
                                <span class="price"><?php echo $cart_total?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        						
<?php require('footer.php')?>        