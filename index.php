<?php require('top.php')?>
<div class="body__overlay"></div>
        
      
               
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>JYSK 2020 - Dobrodosli</h2>
                                        <h1>AKCIJA 40% Popusta</h1> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/krevet.jpg" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               


        <!-- KATEGORIJE -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Najnoviji proizvodi</h2>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
							<?php

                            /* selektujemo 4 najskorie dodata proizvoda */
							$get_product=get_product($con,4);
							foreach($get_product as $list){
							?>
                          
                                <!-- povlacimo slike proizvoda iz baze -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']?>">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                        </a>
                                    </div>
                                    <!-- povlacimo ime, maloprodajnu cijenu i prodajnu cijenu iz baze -->
                                    <div class="fr__product__inner">
                                        <h4><a href="product-details.html"><?php echo $list['name']?></a></h4>
                                        <ul class="fr__pro__prize">
                                            
                                            <li><?php echo $list['price']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php require('footer.php')?>        