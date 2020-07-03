<?php 
require('top.php');
if(isset($_GET['id'])){
    /* selektujemo taj proizvod po svom id-ju */
	$product_id=mysqli_real_escape_string($con,$_GET['id']);
	if($product_id>0){
		$get_product=get_product($con,'','',$product_id);
	}else{
        /* ako dodje do greske, vracemo se na pocetnu stranicu */
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
?>

        <section class="htc__product__details bg__white ptb--100">
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- prikazivanje slike proizvoda -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>">
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">

                            <!-- selektujemo ime proizvoda -->
                                <h2><?php echo $get_product['0']['name']?></h2>
                                <ul  class="pro__prize">
                                 <!-- selektujemo maloprodajnu cijenu i cijenu proizvoda -->
                                 
                                 <li><p>Maloprodajna cijena:</p></li><li class="old__prize"><?php echo $get_product['0']['mrp']?></li>
                                 <li><p>Cijena:</p></li> <li><?php echo $get_product['0']['price']?></li>
                                </ul>
                                 <!-- selektujemo kratak opis proizvoda -->
                                <p class="pro__info"><?php echo $get_product['0']['short_desc']?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                    <!-- provjeravamo da li imamo taj proizvod u inventaru -->
                                        <p><span>Availability:</span> In Stock</p>
                                    </div>
									<div class="sin__desc">
                                        <p><span>Komada:</span> 
										<select id="qty">
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
											<option>7</option>
											<option>8</option>
											<option>9</option>
											<option>10</option>
										</select>
										</p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Kategorija:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories']?></a></li>
                                        </ul>
                                    </div>
                                    
                                    </div>
									<!-- metoda dodavanja u korpu -->
                                </div>
								<a class="fr__btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Dodaj u korpu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        

        <!-- opis proizvoda -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                       
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">Opis</a></li>
                        </ul>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                           
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <?php echo $get_product['0']['description']?>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
										
<?php require('footer.php')?>        