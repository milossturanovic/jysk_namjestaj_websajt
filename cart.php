<?php 
require('top.php');
?>

        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">proizvod</th>
                                            <th class="product-name">ime proizvoda</th>
                                            <th class="product-price">Cijena</th>
                                            <th class="product-quantity">Kolicina</th>
                                            <th class="product-subtotal">Ukupno</th>
                                            <th class="product-remove">Ukloni</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- Ucitavamo sve tabele proizvoda iz baze -->
										<?php
										if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
											$productArr=get_product($con,'','',$key);
											$pname=$productArr[0]['name'];
											$mrp=$productArr[0]['mrp'];
											$price=$productArr[0]['price'];
											$image=$productArr[0]['image'];
											$qty=$val['qty'];
											?>
											<tr>

                                            <!-- Prikazivanjeslike iz baze -->
												<td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"  /></a></td>
												<td class="product-name"><a href="#"><?php echo $pname?></a>
													<ul  class="pro__prize">

                                                    <!-- Prikazivanje maloprodajne cijene -->
														<li class="old__prize"><?php echo $mrp?></li>
														<li><?php echo $price?></li>
													</ul>
												</td>
												<td class="product-price"><span class="amount"><?php echo $price?></span></td>
												<td class="product-quantity"><input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>" />
												
                                                <!-- Ovdje azuriramo koliko cemo kolicinski da kupimo pojedini predmet -->
                                                <br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">Azuriraj</a>
												</td>
												<td class="product-subtotal"><?php echo $qty*$price?></td>
												<td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a></td>
											</tr>
											<?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="<?php echo SITE_PATH?>">Nastavite sa kupovinom</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="<?php echo SITE_PATH?>checkout.php">Kupite</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        
										
<?php require('footer.php')?>        