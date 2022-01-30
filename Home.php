<?php

    include 'config.php'; //connect to db

    //get all products
    session_start(); //check if user is logged in
    if (isset($_SESSION['log']) && $_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    } else { //if no user logged in use an anonynous user
        $user = $collection_users->findOne(["email" => "not_logged"]);
    }
    //get 8 random products and sho as recommended
    $result = $collection_products->find([],
        ['limit' => 8,
        'skip' => rand(0,$collection_products->count())
        ]
    );

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
                <a href="Home.php">
                    <img src="logo.png" id="logo"> <!--logo-->
                    <br>
                    <span>Next Generation of Thrifting</span> <!--caption-->
                </a>
            </div>
            <div class="nav">
                <!--navigation bar, links-->
                <ul class="nav justify-content-center">
                    <li class=nav-item class="dropdown">
                        <a class="nav-link" class="dropdown-toggle" data-toggle="dropdown" href="Home.php">Shop<span class="caret"></span></a>
                        <div class="dropdown-menu col-xs-12">
                            <a class="dropdown-item" href="products.php?action=all">All products</a>
                            <a class="dropdown-header">Shop by category...</a>
                            <a class="dropdown-item" href="products.php?action=category&by=clothes">Clothes</a>
                            <a class="dropdown-item" href="products.php?action=category&by=shoes">Shoes</a>
                            <a class="dropdown-item" href="products.php?action=category&by=accessories">Accessories</a>
                            <a class="dropdown-item" href="products.php?action=category&by=bags">Bags</a>
                            <a class="dropdown-item" href="products.php?action=category&by=gifts">Gifts</a>
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
                    <form  class="form-inline" action="search.php" method="POST">  <!--search bar-->
                        <input type="text" class="form-control" placeholder="Search..." name="search"/>
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </form>
                </ul>
            </div>
        </nav>
        <section id="presection">
            <p>Recommended for you</p>
            <div class="dropdown"> <!--shopping cart/ login butttons-->
                <button class="btn" data-toggle="modal" data-target="#cart_modal"><i class="fa fa-shopping-bag"></i> Cart</button>
                <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true) { ?>
                    <button class="btn"><a href="user.php"><i class="fa fa-user"></i> Your Profile</a></button>
                <?php } else { ?>
                    <button class="btn" data-toggle="modal" data-target="#login_modal"><i class="fa fa-user"></i> Sign In</button>
                <?php } ?>
                <br><br> <!--sort by dropdown list-->
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                    Sort by:
                </button> <!--sort by options-->
                <div class="dropdown-menu">
                <a class="dropdown-item" href="products.php?action=sort&by=relevancy">Relevancy</a>
                    <a class="dropdown-item" href="products.php?action=sort&by=recent">Most Recent</a>
                    <a class="dropdown-item" href="products.php?action=sort&by=price_high">Highest Price</a>
                    <a class="dropdown-item" href="products.php?action=sort&by=price_low">Lowest Price</a>
                </div>
            </div>
        </section>
        <section>
            <div class="bg-1">
                <div class="container">
                    <?php
                        $i = 0;  //counter to add row in each 4 products ?>
                        <div class="row">
                        <?php foreach ($result as $product) { ?>
                            <div class="col-sm-3"> <!--card product-->
                                <div class="card">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#product<?php echo $i ?>"> <!--on click on card get modal-->
                                        <img src="<?php echo $product->images->pic1; ?>.jpg">
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $product->name; ?></p>
                                            <br><br>
                                            <p class="text-right"><?php echo $product->price; ?></p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <!--modal for product info-->
                            <!--i variable uniquely identifies each modal-->
                            <div class="modal" id="product<?php echo $i ?>" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2><?php echo $product->name; ?></h2>
                                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                        </div>
                                        <div class="modal-body">
                                            <!--carousel, multiple product images-->
                                            <div id="carousel-<?php echo $i ?>" role="dialog" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    <!--show multiple images in carousel-->
                                                    <div class="item active"><img src="<?php echo $product->images->pic1; ?>.jpg"></div>
                                                    <?php foreach ($product->images as $pic) {
                                                    if ($pic == $product->images->pic1) { //skip first active pic
                                                        continue; }?>
                                                    <div class="item"><img src="<?php echo $pic; ?>.jpg"></div>
                                                    <?php } ?>
                                                </div>
                                                <?php if (isset($_SESSION['log']) && in_array($product->name, (array)$user->favorites)) { ?>
                                                    <button><a href="favorites.php?action=remove&item=<?php echo $product->name; ?>"><i class="fa fa-heart"></i></a></button>
                                                <?php } else { ?>
                                                    <button><a href="favorites.php?action=add&item=<?php echo $product->name; ?>"><i class="fa fa-heart-o"></i></a></button>
                                                <?php } ?>
                                                <!-- carousel navigation buttons-->
                                                <?php if (count($product->images) > 1) { //if product has multiple pics show navigation buttons ?>
                                                <a class="left carousel-control" href="#carousel-<?php echo $i ?>" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-<?php echo $i ?>" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <div id="info"> <!--info text about product-->
                                                <h3>Description:</h3>
                                                <span><?php echo nl2br($product->description); ?></span> <!--use escape characters-->
                                                <h3>Size:<span class="badge badge-secondary"><?php echo $product->size; ?></span></h3>
                                                <h3>Fit:<span class="badge badge-secondary"><?php echo $product->fit; ?></span></h3>
                                                <!--get multiple material tags-->
                                                <h3>Material:
                                                <?php foreach ($product->materials as $material) { ?>
                                                    <span class="badge badge-secondary"><?php echo $material; ?></span>
                                                <?php } ?>
                                                </h3>
                                                <h3>Price:<span><strong><?php echo $product->price; ?></strong></span></h3>
                                            </div>
                                            <div id="seller_info"> <!-- info text about seller-->
                                                <?php $seller = $collection_users->findOne(["email" => $product->seller]); ?>
                                                <h2><?php echo $seller->name; ?></h2>
                                                <hr>
                                                <h4><?php echo $seller->location; ?></h4>
                                                <?php $count=0;
                                                $sales = $collection_products->find(["seller" => $seller->email]);  //count sales of each seller
                                                foreach ($sales as $sale) {
                                                    $count++;
                                                } ?>
                                                <span><?php echo $count ?> sales</span>
                                                <!--seller rating-->
                                                <?php //count rating stars and find average
                                                $sum = 0;
                                                $count = 0;
                                                $total_rate = 0;
                                                foreach($seller->rate as $rating) {  //get total price of order
                                                    $sum = $sum + (int)$rating->stars;
                                                    $count++;
                                                }
                                                if ($count != 0)
                                                    $total_rate = $sum/$count;
                                                else { ?>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php }
                                                if ((int)$total_rate == 1) { ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php } elseif ((int)$total_rate == 2) { ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php } elseif ((int)$total_rate == 3) { ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php } elseif ((int)$total_rate == 4) { ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                <?php } elseif ((int)$total_rate == 5) { ?>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                <?php } ?>
                                                <br> <!-- seller note-->
                                                <span><?php echo $seller->description; ?></span>
                                                <!--show ratings of seller-->
                                                <div id="ratings">
                                                    <?php foreach($seller->rate as $rating) {  ?>
                                                    <h4><?php echo $rating->buyer; ?></h4>
                                                    <hr>
                                                    <?php if ($rating->stars == 1) { ?>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        <?php } elseif ($rating->stars == 2) { ?>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        <?php } elseif ($rating->stars == 3) { ?>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        <?php } elseif ($rating->stars == 4) { ?>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                        <?php } elseif ($rating->stars == 5) { ?>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                        <?php } ?>
                                                        <br>
                                                        <span><?php echo nl2br($rating->comment); ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <button id="add_cart" class="btn"><a href="cart.php?action=add&item=<?php echo $product->name; ?>">Add to Cart</a></button> <!--add to cart button-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $i++; } ?>
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
        <section id="cart">
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
                                         <?php $i=0;
                                            foreach($user->cart as $item) { //for each item in cart
                                            $item = $collection_products->findOne(["name" => $item]); //find product in db?>
                                            <tr>
                                                <!--call modal for product details, pass product as parameter in modal-->
                                                <td><a id="item" href="" data-toggle="modal" data-product="<?php echo $item->name; ?>"><img src="<?php echo $item->images->pic1 ?>.jpg"/></a></td>
                                                <td><a id="item" href="" data-toggle="modal" data-product="<?php echo $item->name; ?>"><?php echo $item->name ?></a></td>
                                                <td><?php echo $item->price ?></td>
                                                <td><a href="cart.php?action=remove&item=<?php echo $item->name; ?>"><i class="fa fa-close"></i></a></td>
                                            </tr>
                                        <?php $i++; } ?>
                                        </table>
                                        <?php if (count((array)$user->cart) == 0) { //if no products on cart show message ?>
                                            <p style="font-weight:normal"><?php echo 'Nothing here. Add some items to cart...'; ?> </p>
                                        <?php } else { ?>
                                        <hr>
                                        <!--get total price of products-->
                                        <?php $sum=0;
                                        foreach($user->cart as $item) {
                                        $item = $collection_products->findOne(["name" => $item]); //find products in db
                                            $sum = $sum + (float)$item->price;
                                        } ?>
                                        <p>Total <span>   <?php echo $sum; ?></span>$</p>
                                        <button class="btn btn-block"><a data-target="#checkout_modal" data-toggle="modal" href="#checkout_modal">Checkout</a></button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--TO DO modal for product info-->
            <div class="modal" id="product" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="uni"></h2>
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                        </div>
                        <div class="modal-body">
                            <!--carousel, multiple product images-->
                            <div id="carousel-<?php echo $i ?>" role="dialog" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <!--show multiple images in carousel-->
                                    <div class="item active"><img src="<?php echo $product->images->pic1; ?>.jpg" style="width:400px;"></div>
                                    <?php foreach ($product->images as $pic) {
                                    if ($pic == $product->images->pic1) { //skip first active pic
                                        continue; }?>
                                    <div class="item"><img src="<?php echo $pic; ?>.jpg" style="width:400px;"></div>
                                    <?php } ?>
                                </div>
                                <button><i class="fa fa-heart"></i></button>
                                <!-- carousel navigation buttons-->
                                <?php if (count($product->images) > 1) { //if product has multiple pics show navigation buttons ?>
                                <a class="left carousel-control" href="#carousel-<?php echo $i ?>" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-<?php echo $i ?>" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                </a>
                                <?php } ?>
                            </div>
                            <div id="info"> <!--info text about product-->
                                <h3>Description:</h3>
                                <span><?php echo nl2br($product->description); ?></span> <!--use escape characters-->
                                <h3>Size:<span class="badge badge-secondary"><?php echo $product->size; ?></span></h3>
                                <h3>Fit:<span class="badge badge-secondary"><?php echo $product->fit; ?></span></h3>
                                <!--get multiple material tags-->
                                <h3>Material:
                                <?php foreach ($product->materials as $material) { ?>
                                    <span class="badge badge-secondary"><?php echo $material; ?></span>
                                <?php } ?>
                                </h3>
                                <h3>Price:<span><strong><?php echo $product->price; ?></strong></span></h3>
                            </div>
                            <div id="seller_info"> <!-- info text about seller-->
                                <?php $seller = $collection_users->findOne(["email" => $product->seller]); ?>
                                <h2><?php echo $seller->name; ?></h2>
                                <hr>
                                <h4><?php echo $seller->location; ?></h4>
                                <?php $count=0;
                                $sales = $collection_products->find(["seller" => $seller->email]);  //count sales of each seller
                                foreach ($sales as $sale) {
                                    $count++;
                                } ?>
                                <span><?php echo $count ?> sales</span>
                                <!--seller rating-->
                                <?php //count rating stars and find average
                                $sum_rate = 0;
                                $count = 0;
                                $total_rate = 0;
                                foreach($seller->rate as $rating) {  //get total price of order
                                    $sum_rate = $sum_rate + (int)$rating->stars;
                                    $count++;
                                }
                                if ($count != 0)
                                    $total_rate = $sum/$count;
                                else { ?>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                <?php }
                                if ((int)$total_rate == 1) { ?>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                <?php } elseif ((int)$total_rate == 2) { ?>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                <?php } elseif ((int)$total_rate == 3) { ?>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                <?php } elseif ((int)$total_rate == 4) { ?>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                <?php } elseif ((int)$total_rate == 5) { ?>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                <?php } ?>
                                <br> <!-- seller note-->
                                <span><?php echo $seller->description; ?></span>
                                <!--show ratings of seller-->
                                <div id="ratings">
                                    <?php foreach($seller->rate as $rating) {  ?>
                                    <h4><?php echo $rating->buyer; ?></h4>
                                    <hr>
                                    <?php if ($rating->stars == 1) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        <?php } elseif ($rating->stars == 2) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        <?php } elseif ($rating->stars == 3) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        <?php } elseif ($rating->stars == 4) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                        <?php } elseif ($rating->stars == 5) { ?>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                        <?php } ?>
                                        <br>
                                        <span><?php echo nl2br($rating->comment); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <button class="btn"><a href="cart.php?action=add&item=<?php echo $product->name; ?>">Add to Cart</a></button> <!--add to cart button-->
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
                                                <input type="text" class="form-control" id="card_num" required maxlength="19" type="tel" pattern="\d*"/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="card_name">Cardholder Name</label>
                                                <input type="text" class="form-control" id="card_name" required/>
                                            </div>
                                            <div class="form-outline">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="card_expire">Expiry</label>
                                                        <input type="text" class="form-control" id="card_expire" required/>
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
                                            </div>
                                            <button class="btn btn-block">Purchase <span><?php echo $sum; ?></span> <span>$</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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