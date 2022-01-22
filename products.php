<?php

    //start xampp/apache
    //start mongo -> (adm) net start mongodb
    //start mongo shell -> (adm) mongo
    //access php files localhost/pr1/final/login.php
    require '../vendor/autoload.php';

    $m = new MongoDB\Client("mongodb://127.0.0.1/");  //connection
    $db = $m->Thriftie_DB; //database
    $collection = $db->Products; //collection
    //get values from html input fields
    //execute query

    if ($_GET['action'] == 'all'){
        $result = $collection->find();
    }

    if ($_GET['action'] == 'add'){

        $document = array(
            "pic1" => "items/item6"
        );

        $result = $collection->UpdateOne(["name" => "Gold Carnelian Necklace"],['$set' => $document]); //create user and redirect

    }

?>

<html>
    <head>
        <title>Thriftie Marketplace</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--favicon-->
		<link rel="shortcut icon" href="favicon.png"/>
        <!--cart/user login signs-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--import css file-->
        <link rel="stylesheet" href="style.css" type="text/css">
        <!--import JavaScript functions-->
        <script src="functions.js" type="text/javascript"></script>
        <!--import bootstrap file-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar">
            <!--navigation bar, header-->
            <div class="navbar-header">
                <a href="Home.html"> <!--when click on logo/caption redirect to home-->
                    <img src="logo.png" id="logo"> <!--logo-->
                    <br>
                    <span>Next Generation of Thrifting</span> <!--caption-->
                </a>
            </div>
            <div class="nav">
                <!--navigation bar, links-->
                <ul class="nav justify-content-center"> <!--align items in center-->
                    <li class=nav-item class="dropdown"> <!--on click on link get dropdown list with categories-->
                        <a class="nav-link" class="dropdown-toogle" data-toggle="dropdown" href="Home.html">Shop<span class="caret"></span></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="products.php?action=all">All products</a>
                            <a class="dropdown-header">Shop by category...</a>
                            <a class="dropdown-item" href="#">Clothes</a>
                            <a class="dropdown-item" href="#">Shoes</a>
                            <a class="dropdown-item" href="#">Accessories</a>
                            <a class="dropdown-item" href="#">Bags</a>
                            <a class="dropdown-item" href="#">Gifts</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Sell.html">Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="About Us.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Help Center.html">Help Center</a>
                    </li>
                    <form  class="form-inline my-2" action="#">  <!--search bar-->
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </form>
                </ul>
            </div>
        </nav>
        <section id="presection">
            <p>Recommended for you</p>
            <div class="dropdown"> <!--shopping cart/ login butttons-->
                <button class="btn" data-toggle="modal" data-target="#cart_modal"><i class="fa fa-shopping-bag"></i> Cart</button>
                <button class="btn" data-toggle="modal" data-target="#login_modal"><i class="fa fa-user"></i> Sign in</button>
                <br><br> <!--sort by dropdown list-->
                <!--<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                    Sort by:
                </button> <!--sort by options-->
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Relevancy</a>
                    <a class="dropdown-item" href="#">Most Recent</a>
                    <a class="dropdown-item" href="#">Highest Price</a>
                    <a class="dropdown-item" href="#">Lowest Price</a>
                </div>
            </div>
        </section>
        <section>
            <div class="bg-1">
                <div class="container">
                    <!--first 4 products-->
                    <div class="row">
                        <?php
                            $i = 0;  //counter to add row in each 4 products
                            foreach ($result as $product) { ?>
                                <div class="col-sm-3"> <!--first product, each product in card-->
                                    <div class="card">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#product1"> <!--on click on card get modal-->
                                            <img src="<?php echo $product->pic1; ?>.jpg"> <!--product pic-->
                                            <div class="card-body">
                                                <p class="card-text"><?php echo $product->name; ?></p> <!-- product short description-->
                                                <br><br>
                                                <p class="text-right"><?php echo $product->price; ?></p> <!-- product price-->
                                            </div>
                                        </button>
                                    </div>
                                </div>
                        <?php $i++;
                        if ($i == 4) { //on 4th product open div row?>
                        <div class="row">
                        <?php }
                        if ($i == 8) {  //on 8th product close div row ?>
                        </div>
                        <?php $i=0; } //after 8th product initialize counter for next 4 products
                    } ?>
                    </div>
                <!--modals-->
                <div class="modal" id="product1" role="dialog"> <!--modal for product 1-->
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Leather Shoulder bag</h2> <!--modal header-->
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel, multiple product images-->
                                <div id="carousel-one" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item2.jpg"></div>
                                        <div class="item"><img src="items/item2a.jpg"></div>
                                        <div class="item"><img src="items/item2b.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <!-- carousel navigation buttons-->
                                    <a class="left carousel-control" href="#carousel-one" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-one" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info"> <!--info text about product-->
                                    <h3>Description:</h3>
                                    <span>The leather bag is ideal for school, university, work or just to go shopping. You can put a DIN A4 folder in it.<br>
                                        Size of the leather bag:<br>
                                        Width top: 15.8"<br>
                                        Width bottom: 13"<br>
                                        Height: 13.78"<br>
                                        Depth: 5.12"<br>
                                        Shoulder straps: 25,60 inch<br>
                                        Crossbody strap: 33,46 - 41,34 inch adjustable<br>
                                        Frontpockets: width: 5,51 inch, height: 6,69 inch</span>
                                    <h3>Size:<span class="badge badge-secondary">One size</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">-</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Leather</span></h3>
                                    <h3>Price:<span><strong>23.00$</strong></span></h3>
                                </div>
                                <div id="seller_info"> <!-- info text about seller-->
                                    <h2>Athina Tsilikou</h2>
                                    <hr>
                                    <h4>Athens, Greece</h4>
                                    <span>54 sales</span>
                                    <span class="fa fa-star checked"></span> <!--seller rating-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <br> <!-- seller note-->
                                    <span>If you are not satisfied with the product, it is no problem! You easily send it back to my address and after receiving the product in a good condition you will immediately get your money back!</span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button> <!--add to cart button-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product2" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Organic Handmade Striped Dress</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-two" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item1.jpg"></div>
                                        <div class="item"><img src="items/item1a.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <a class="left carousel-control" href="#carousel-two" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-two" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>Handmade striped linen dress. Dress with short folded sleeves and buttons opening at the front
                                        side of the dress is perfect as a maternity dress too and friendly for breastfeeding.
                                        Made from locally manufactured pre-washed linen fabric and is perfect for all seasons.<br>
                                        ----------------------------------------------<br>
                                        - loose fit bodice<br>
                                        - with buttons opening at the front side<br>
                                        - short sleeves<br>
                                        - hidden pockets in side seams of the skirt<br>
                                        - body length 39,3"/100 cm</span>
                                    <h3>Size:<span class="badge badge-secondary">Small</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">Skinny</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Linen</span></h3>
                                    <h3>Price:<span><strong>14.60$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>Tyler Scott</h2>
                                    <hr>
                                    <h4>Harrisburg, Pennsylvania</h4>
                                    <span>101 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <br>
                                    <span>WE TRY TO OFFER OUR TAILORS AS BEST WORKING CONDITIONS AS POSSIBLE.</span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product3" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Beaded Silver Necklace</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-three" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item7.jpg"></div>
                                        <div class="item"><img src="items/item7a.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <a class="left carousel-control" href="#carousel-three" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-three" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>Pretty faceted and iridescent opalite drop feature design.<br>
                                        ~ Dainty, silver plated beaded chain, approx 15" shortest length.<br>
                                        ~ Lobster clasp and 2" extender to close.<br>
                                        ~ Perfect for layering with both chokers and long pendants.<br></span>
                                    <h3>Size:<span class="badge badge-secondary">One Size</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">-</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Silver</span><span> </span><span class="badge badge-secondary">Opalite</span></h3>
                                    <h3>Price:<span><strong>13.00$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>Philippa Harman</h2>
                                    <hr>
                                    <h4>England, United Kingdom</h4>
                                    <span>191 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <br>
                                    <span> Due to the ever changing situation amidst the COVID-19 pandemic, I kindly ask all customers to expect orders to take longer than usual to arrive. Estimated, but not guaranteed delivery times for standard shipping are as follows<br>
                                        UK orders - Approx 2-4 working days after dispatch.<br>
                                        INTERNATIONAL orders - 2-6 weeks after dispatch.<br></span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product4" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Vintage 90's Unisex Long Sleeve Shirt</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-four" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item9.jpg"></div>
                                        <div class="item"><img src="items/item9a.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <a class="left carousel-control" href="#carousel-four" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-four" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>Material: 100% Linen.<br>
                                        Style: AnSanLinen<br>
                                        Sample Color: Natural, Black</span>
                                    <h3>Size:<span class="badge badge-secondary">Large</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">Oversized</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Linen</span></h3>
                                    <h3>Price:<span><strong>23.50$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>Andris and Sandor Strelnieki</h2>
                                    <hr>
                                    <h4>Riga, Latvia</h4>
                                    <span>17 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <br>
                                    <span>Suitable for people with sensitive skin. 
                                        Linen can be used in all life situations, sports, leisure and official events.
                                         You can always get advice or size adjustments by contacting me. <br>
                                         Thank you, Andris and Sandor.
                                    </span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product5" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Anime Unisex Sweater - anime is life</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-five" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item8.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>A classic styled unisex sweater with a crew neckline. <br>
                                        Soft & smooth inside fabric for the ultimate comfort feel. <br>
                                        Machine Wash (30°- 40°max Inside out).</span>
                                    <h3>Size:<span class="badge badge-secondary">X Large</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">Oversized</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Cotton</span><span> </span><span class="badge badge-secondary">Polyester</span></h3>
                                    <h3>Price:<span><strong>17.80$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>Fergie Warya</h2>
                                    <hr>
                                    <h4>London, United Kingdom</h4>
                                    <span>32 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <br>
                                    <span>Providing Unisex t-shirts for birthday gifts and casual wear. The shirts are High Premium Quality 100% Cotton.</span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product6" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Gold Carnelian Necklace</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-six" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item6.jpg"></div>
                                        <div class="item"><img src="items/item6a.jpg"></div>
                                        <div class="item"><img src="items/item6b.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <a class="left carousel-control" href="#carousel-six" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-six" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>This Necklace is crafted with a genuine Carnelian stone.<br>
                                        * Gift for her/gift for him/gift for mom<br>
                                        * Perfect for daily use or for any occasions<br>
                                        * Perfect match with other necklaces</span>
                                    <h3>Size:<span class="badge badge-secondary">One Size</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">-</span></h3>
                                    <h3>Material:<span>Not Available</span></h3>
                                    <h3>Price:<span><strong>17.80$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>Matt Hoop</h2>
                                    <hr>
                                    <h4>Toronto, Canada</h4>
                                    <span>197 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <br>
                                    <span></span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product7" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Leather minimalist Wallet</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-seven" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item5.jpg"></div>
                                        <div class="item"><img src="items/item5a.jpg"></div>
                                        <div class="item"><img src="items/item5b.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <a class="left carousel-control" href="#carousel-seven" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-seven" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>• Fits up to 16 credit cards.<br>
                                        • 2 inner pockets for cards plus a money pocket.<br>
                                        • Its designed to hold US bills or other currencies with similar bill dimensions. <br>
                                        • Practical elastic band.<br>
                                        The wallet measures folded (approx): 4 "(W) x3"(H) 10,5 cm(W) x 7,5 cm(H)</span>
                                    <h3>Size:<span class="badge badge-secondary">One Size</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">-</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Leather</span></h3>
                                    <h3>Price:<span><strong>5.00$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>Mimoun Karl</h2>
                                    <hr>
                                    <h4>Málaga, Spain</h4>
                                    <span>102 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star ckecked"></span>
                                    <span class="fa fa-star"></span>
                                    <br>
                                    <span>Welcome! Here you will find leather accessories.<br>
                                        Thanks for visiting.</span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal" id="product8" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Plants are friends - Shirt Tee</h2>
                                <!--exit button-->
                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <!--carousel-->
                                <div id="carousel-eight" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="items/item3.jpg"></div>
                                        <div class="item"><img src="items/item3a.jpg"></div>
                                    </div>
                                    <button><i class="fa fa-heart"></i></button>
                                    <a class="left carousel-control" href="#carousel-eight" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-eight" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <div id="info">
                                    <h3>Description:</h3>
                                    <span>PROFESSIONALLY PRINTED USING ECO FRIENDLY WATER BASED INKS FOR A SUPERIOR RETAIL QUALITY FINISH onto a VERY HIGH QUALITY SWEATSHIRT</span>
                                    <h3>Size:<span class="badge badge-secondary">Medium</span></h3>
                                    <h3>Fit:<span class="badge badge-secondary">Oversized</span></h3>
                                    <h3>Material:<span class="badge badge-secondary">Cotton</span><span> </span><span class="badge badge-secondary">Fleece</span></spam></span></h3>
                                    <h3>Price:<span><strong>13.40$</strong></span></h3>
                                </div>
                                <div id="seller_info">
                                    <h2>James Fryer</h2>
                                    <hr>
                                    <h4>Paignton, United Kingdom</h4>
                                    <span>2 sales</span>
                                    <span class="fa fa-star checked"></span> <!--rate seller-->
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <br>
                                    <span>I am that confident you will be happy with your purchase that I offer all of mine customers a full **30 DAY MONEY BACK GUARANTEE.**
                                        Thank you for looking at my products!</span>
                                </div>
                                <button type="submit" class="btn" data-dismiss="modal">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="modal" id="login_modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center ">
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h3>Sign in</h3>
                                            <form method="post" action="login.php">
                                                <span id="error_handling"></span>
                                                <div class="form-outline">
                                                    <label class="form-label" for="login_email">Email</label>
                                                    <input type="email" class="form-control" id="login_email" name="login_email" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="login_pass">Password</label>
                                                    <input type="password" class="form-control" id="login_pass" name="login_pass" required minlength="6"/>
                                                </div>
                                                <!-- Checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"/>
                                                    <label class="form-check-label">Remember me</label>
                                                </div>
                                                <button class="btn btn-block">Login</button>
                                            </form>
                                            <button class="btn btn-block" style="background-color: #dd4b39;"><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google"></i> Sign up with google</a></button>
                                            <button class="btn btn-block" style="background-color: #3b5998;"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-f"></i> Sign up with facebook</a></button>
                                        <span>You don't have an account?</span><a data-target="#signup_modal" data-toggle="modal" href="#signup_modal"> Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="modal" id="signup_modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center ">
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h3>Sign Up</h3>
                                            <!--send data to php file, check validity of password and confirm password-->
                                            <form method="post" action="signup.php" oninput='confirm_pass.setCustomValidity(confirm_pass.value != sign_pass.value ? "Passwords do not match." : "")'>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_name">Name</label>
                                                    <input type="text" class="form-control" id="sign_name" name="sign_name" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_email">Email</label>
                                                    <input type="email" class="form-control" id="sign_email" name="sign_email" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_pass">Password</label>
                                                    <input type="password" class="form-control" id="sign_pass" name="sign_pass" required minlength="6"/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="confirm_pass">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" required/>
                                                </div>
                                                <!-- Checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"/>
                                                    <label class="form-check-label">I would like to receive exclusive emails about product offers</label>
                                                </div>
                                                <button class="btn btn-block">Sign Up</button>
                                            </form>
                                        <button class="btn btn-block" style="background-color: #dd4b39;"><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google"></i> Sign up with google</a></button>
                                        <button class="btn btn-block" style="background-color: #3b5998;"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-f"></i> Sign up with facebook</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--cart-->
        <!--TO DO fix cart to be adjustable-->
        <!--TO DO fix buttons to remove item from cart-->
        <section>
            <div class="modal" id="cart_modal" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body text-center">
                            <h3>Shopping Bag</h3>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-borderedless">
                                            <tr>
                                                <td><img src="items/item1.jpg"/></td>
                                                <td>Organic Handmade Striped Dress</td>
                                                <td>14.60$</td>
                                                <td><button><i class="fa fa-close"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td><img src="items/item7.jpg"/></td>
                                                <td>Beaded Silver Necklace</td>
                                                <td>13.00$</td>
                                                <td><button><i class="fa fa-close"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td><img src="items/item8.jpg"/></td>
                                                <td>Leather Shoulder bag</td>
                                                <td>23.00$</td>
                                                <td><button><i class="fa fa-close"></i></button></td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <!--TO DO fix total with js-->
                                        <p>Total <span>   10</span>$</p>
                                        <button class="btn btn-block"><a data-target="#checkout_modal" data-toggle="modal" href="#checkout_modal">Checkout</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--modal checkout, payment form-->
        <!--check validity of values + add extra js-->
        <section>
            <div class="modal" id="checkout_modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body text-center">
                            <h3>Checkout</h3>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="#" method="post">
                                            <div class="form-outline">
                                                <label class="form-label" for="card_num">Card Number</label>
                                                <input type="text" class="form-control" id="card_num" required maxlength="19"/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="card_name">Cardholder Name</label>
                                                <input type="text" class="form-control" id="card_name" required/>
                                            </div>
                                            <div class="form-outline">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="card_expire">Expiry</label>
                                                        <input type="text" class="form-control" id="card_expire" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="card_cvv">CVV</label>
                                                        <input type="text" class="form-control" id="card_cvv" maxlength="3" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="alt_pay">Or Purchase with:</label>
                                                <div class="row">
                                                    <div class="col-md-4 justify-content-center d-flex ">
                                                        <input type="radio" class="btn-check" name="alt_pay" id="paypal" autocomplete="off">
                                                        <label class="btn btn-secondary" for="paypal"><span class="fa fa-paypal"></span> PayPall</label>
                                                    </div>
                                                    <div class="col-md-4 justify-content-center d-flex ">
                                                        <input type="radio" class="btn-check" name="alt_pay" id="google" autocomplete="off">
                                                        <label class="btn btn-secondary" for="google"><span class="fa fa-google"></span> Google Pay</label>
                                                    </div>
                                                    <div class="col-md-4 justify-content-center d-flex ">
                                                        <input type="radio" class="btn-check" name="alt_pay" id="apple" autocomplete="off">
                                                        <label class="btn btn-secondary" for="apple"><span class="fa fa-apple"></span> Apple Pay</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline">
                                                <br>
                                                <label class="form-label" for="sign_pass">Billing Address</label>
                                                <div class="address">
                                                    <select class="form-select">
                                                        <option value="4" selected>United States</option>
                                                        <option value="1">India</option>
                                                        <option value="2">Australia</option>
                                                        <option value="3">Greece</option>
                                                        <option value="3">Germany</option>
                                                        <option value="3">UK</option>
                                                        <option value="3">Italy</option>
                                                    </select>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input class="form-control zip" type="text" placeholder="ZIP" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control state" type="text" placeholder="State" required>
                                                        </div>
                                                    </div>
                                            </div>
                                            <!--TO DO get total from js-->
                                            <button class="btn btn-block">Purchase <span>35.80</span> <span>$</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Pagination
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li> 
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>-->
        <!--sell a product, promotion button-->
        <button type="button" class="btn" id="promo"><a href="sell.html">+ Sell a Product</a></button>
        <!--footer-->
        <footer class="text-right"> <!--align text to the right-->
            <br><br>
            <button type="button" class="btn btn-outline-dark">Download the app</button>
            <span>&copy; 2021 Thriftie, Second Hand Marketplace</span>
        </footer>
    </body>
</html>
