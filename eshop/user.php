<?php

    include 'config.php';  //connect to db

    session_start();
    if ($_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
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
        <link rel="stylesheet" href="style.css?v=1" type="text/css">
        <!--import JavaScript functions-->
        <script src="functions.js" type="text/javascript"></script>
        <!--import JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <a href="Home.php"> <!--when click on logo/caption redirect to home-->
                    <img src="logo.png" id="logo"> <!--logo-->
                    <br>
                    <span>Next Generation of Thrifting</span> <!--caption-->
                </a>
            </div>
            <div class="nav">
                <!--navigation bar, links-->
                <ul class="nav justify-content-center"> <!--align items in center-->
                    <li class=nav-item class="dropdown"> <!--on click on link get dropdown list with categories-->
                        <a class="nav-link" class="dropdown-toggle" data-toggle="dropdown" href="Home.php">Shop<span class="caret"></span></a>
                        <div class="dropdown-menu col-xs-12">
                            <a class="dropdown-item" href="products.php?action=all">All products</a>
                            <a class="dropdown-header">Shop by category...</a>
                            <a class="dropdown-item" href="products.php?action=category&by=clothes">Clothes</a>
                            <a class="dropdown-item" href="products.php?action=category&by=shoes">Shoes</a>
                            <a class="dropdown-item" href="products.php?action=category&by=accessories">Accessories</a>
                            <a class="dropdown-item" href="products.php?action=category&by=bags">Bags</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Sell_page.php">Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="About Us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Help Center.php">Help Center</a>
                    </li>
                    <form  class="form-inline" action="search.php" method="POST">  <!--search bar-->
                        <input type="text" class="form-control" placeholder="Search..." name="search"/>
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </form>
                </ul>
            </div>
        </nav>
        <section id="presection">
            <div class="dropdown text-right"> <!--shopping cart/ login butttons-->
                <button class="btn" data-toggle="modal" data-target="#cart_modal"><i class="fa fa-shopping-bag"></i> Cart</button>
                <button class="btn" data-toggle="modal" data-target="#logout_modal">Logout</button>
            </div>
            <!--confirmation logout modal-->
            <div class="modal" id="logout_modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Logout</h2>
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                        </div>
                        <div class="modal-body text-center">
                            <h3>Are you sure you want to logout?</h3>
                            <button class="btn"><a href="logout.php">Yes</a></button>
                            <button class="btn" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--cart-->
        <section id="cart">
            <div class="modal" id="cart_modal" role="dialog">
                <div class="modal-dialog" role="document">
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
        </section>
        <!--modal checkout, payment form-->
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
                                        <form action="order.php" method="post">
                                            <div class="form-outline">
                                                <label class="form-label" for="card_num">Card Number</label>
                                                <input type="text" class="form-control" id="card_num" maxlength="19"/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="card_name">Cardholder Name</label>
                                                <input type="text" class="form-control" id="card_name"/>
                                            </div>
                                            <div class="form-outline">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="card_expire">Expiry</label>
                                                        <input type="text" class="form-control" id="card_expire"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="card_cvv">CVV</label>
                                                        <input type="text" class="form-control" id="card_cvv" maxlength="3"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="alt_pay">Or Purchase with:</label>
                                                <div class="row">
                                                    <div class="col-md-4 justify-content-center d-flex ">
                                                        <input type="radio" class="btn-check" name="alt_pay" id="paypal" autocomplete="off">
                                                        <label class="btn btn-secondary" for="paypal"><span class="fa fa-paypal"></span> PayPal</label>
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
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input class="form-control zip" type="text" placeholder="Number" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-control state" type="text" placeholder="Street" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-control zip" type="text" placeholder="City" required>
                                                    </div>
                                                </div>
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
        <section id="user">
            <h1>Your Profile</h1>
            <div class="card border-0">
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <img src="favicon.png" class="card-img">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h2 class="card-title" id="user_name"><?php echo $user->name; ?></h2>
                            <p class="card-text">Email: <span><?php echo $user->email; ?></span><a href="#email_update" data-target="#email_update" data-toggle="modal"><i class="fa fa-edit"></i></a></p>
                            <p class="card-text">Location: <span><?php echo $user->location; ?></span><a href="#location_update" data-target="#location_update" data-toggle="modal"><i class="fa fa-edit"></i></a></p>
                            <p><a class="card-text" href="#pass_update" data-target="#pass_update" data-toggle="modal">Change my password</a></p>
                            <label style="font-weight:10" class="card-text">
                                Describe yourself as a seller:
                                <a href="#description_update" data-target="#description_update" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </label>
                            <textarea cols="40" rows="5" id="sign_descr" name="sign_descr" readonly><?php echo $user->description; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center">For further help, please <a href="help center.php#contact">contact us here</a>.</p>
        </section>
        <!--update email modal-->
        <section>
            <div class="modal" id="email_update" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center ">
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h3>Update your email</h3>
                                        <form method="POST" action="update_user.php?action=email">
                                            <div class="form-outline">
                                                <label class="form-label" for="sign_email">Old Email</label>
                                                <input type="email" class="form-control" id="sign_email" name="sign_email" required/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="sign_pass">Password</label>
                                                <input type="password" class="form-control" id="sign_pass" name="sign_pass" minlength="6" required/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="new_email">New Email</label>
                                                <input type="email" class="form-control" id="new_email" name="new_email" required/>
                                            </div>
                                            <button class="btn btn-block">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--update password modal-->
        <section>
            <div class="modal" id="pass_update" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center ">
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h3>Update your Password</h3>
                                        <!--check password confirmation-->
                                        <form method="POST" action="update_user.php?action=password" oninput='confirm_new.setCustomValidity(confirm_new.value != new_pass.value ? "Passwords do not match." : "")'>
                                            <div class="form-outline">
                                                <label class="form-label" for="sign_email">Email</label>
                                                <input type="email" class="form-control" id="sign_email" name="sign_email" required/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="sign_pass">Old Password</label>
                                                <input type="password" class="form-control" id="sign_pass" name="sign_pass" minlength="6" required/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="new_pass">New Password</label>
                                                <input type="password" class="form-control" id="new_pass" name="new_pass" minlength="6" required/>
                                            </div>
                                            <div class="form-outline">
                                                <label class="form-label" for="confirm_new">Confirm New Password</label>
                                                <input type="password" class="form-control" id="confirm_new" name="confirm_new" minlength="6" required/>
                                            </div>
                                            <button class="btn btn-block">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--update location modal-->
        <section>
            <div class="modal" id="location_update" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h3>Update your location</h3>
                                        <form method="POST" action="update_user.php?action=location">
                                            <div class="form-outline">
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_email">Email</label>
                                                    <input type="email" class="form-control" id="sign_email" name="sign_email" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_pass">Password</label>
                                                    <input type="password" class="form-control" id="sign_pass" name="sign_pass" minlength="6" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_city">City</label>
                                                    <input type="text" class="form-control" id="sign_city" name="sign_city"/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_country">Country</label>
                                                    <input type="text" class="form-control" id="sign_country" name="sign_country"/>
                                                </div>
                                            </div>
                                            <button class="btn btn-block">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--update description-->
        <section>
            <div class="modal" id="description_update" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card-body text-center">
                                        <h3>Update your description</h3>
                                        <form method="POST" action="update_user.php?action=description">
                                            <div class="form-outline">
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_email">Email</label>
                                                    <input type="email" class="form-control" id="sign_email" name="sign_email" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_pass">Password</label>
                                                    <input type="password" class="form-control" id="sign_pass" name="sign_pass" minlength="6" required/>
                                                </div>
                                                <div class="form-outline">
                                                    <label class="form-label" for="sign_descr">Describe yourself</label>
                                                    <textarea class="form-control" cols="34" rows="5" id="sign_descr" name="sign_descr"><?php echo $user->description; ?></textarea>
                                                </div>
                                            </div>
                                            <button class="btn btn-block">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="favorites">
            <h1>Favorites</h1>
            <div class="container justify-content-center">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderedless">
                        <?php
                        $i = 0;
                        foreach ($user->favorites as $favorite) {
                            $product = $collection_products->findOne(["name" => $favorite]); ?>
                            <tr>
                                <td><a href="#product<?php echo $i ?>" data-target="#product<?php echo $i ?>" data-toggle="modal"><img src="<?php echo $product->images->pic1; ?>.jpg"/></a></td>
                                <td><a href="#product<?php echo $i ?>" data-target="#product<?php echo $i ?>" data-toggle="modal"><?php echo $product->name; ?></a></td>
                                <td><?php echo $product->price; ?></td>
                                <td><button><a href="favorites.php?action=remove&item=<?php echo $product->name; ?>"><i class="fa fa-heart"></i></a></button></td>
                                <td><button><a href="cart.php?action=add&item=<?php echo $product->name; ?>"><i class="fa fa-shopping-bag"></i></a></button></td>
                            </tr>
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
                    <?php $i++; }
                    if (count((array)$user->favorites) == 0) { //if no products on cart show mesg ?>
                            <p id="msg"><?php echo 'No items on favorites...'; } ?> </p>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section id="history">
            <h1>History</h1>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h2>Your Orders</h2>
                        <table id="1" class="table table-borderedless">
                            <?php $i=0;
                            foreach ($user->orders as $order) {  //for each order
                                $item = $collection_products->findOne(["name" => $order[0]]); //find first item of each order ?>
                            <tr>
                                <td><a href="#order<?php echo $i ?>" data-toggle="modal" data-target="#order<?php echo $i ?>"><img src="<?php echo $item->images->pic1; ?>.jpg" style="opacity: 0.5"/></a></td>
                                <?php $count = count($order)-1;//count items in order, -1 containing total cost of order?>
                                <td><a href="#order<?php echo $i ?>" data-toggle="modal" data-target="#order<?php echo $i ?>"><span><?php echo $count; ?></span> Items</a></td>
                                <td>Total: <span><?php echo $order[$count]->total.'$'; ?></span></td>
                            </tr>
                            <div class="modal" id="order<?php echo $i ?>" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                        </div>
                                        <div class="modal-body text-center">
                                            <h3>Order</h3>
                                            <div class="container">
                                                <div class="table">
                                                    <?php
                                                    foreach ($order as $item) {
                                                        $product = $collection_products->FindOne(["name" => $item]);
                                                        if (gettype($item) != 'object') { ?>
                                                        <div class="row">
                                                            <div class="cell"><img src="<?php echo $product->images->pic1; ?>.jpg"/></div>
                                                            <div class="cell"><?php echo $product->name ?></div>
                                                            <div class="cell"><?php echo $product->price ?></div>
                                                            <!--pass seller name to modal via Jquery-->
                                                            <?php $seller = $collection_users->findOne(["email" => $product->seller]) ?>
                                                            <div class="cell"><a id="link" href="" data-toggle="modal" data-seller="<?php echo $seller->name; ?>"><i class="fa fa-star"></i></a></div>
                                                        </div>
                                                        <hr>
                                                    <?php }  } ?>
                                                </div>
                                                <hr>
                                                <p><span><strong>Total:    <?php echo $order[$count]->total.'$'; ?></strong></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; }
                        if (count((array)$user->orders) == 0) { //if no orders  show message ?>
                                <p id="msg" ><?php echo 'No history yet.'; } ?>
                        </table>
                        <!--modal rate seller of product-->
                        <div class="modal" id="rate" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h3>Rate</h3>
                                        <span id="seller"></span>
                                        <form id="form" method="POST" onsubmit="seller()">
                                            <div class="form-outline">
                                                <div class="form-outline">
                                                    <div class="rating text-center">
                                                        <input type="radio" name="rating" value="5" id="5">
                                                        <label for="5">☆</label>
                                                        <input type="radio" name="rating" value="4" id="4">
                                                        <label for="4">☆</label>
                                                        <input type="radio" name="rating" value="3" id="3">
                                                        <label for="3">☆</label>
                                                        <input type="radio" name="rating" value="2" id="2">
                                                        <label for="2">☆</label>
                                                        <input type="radio" name="rating" value="1" id="1" checked>
                                                        <label for="1">☆</label>
                                                    </div>
                                                </div>
                                                <div class="form-outline">
                                                    <textarea class="form-control" rows="3" id="rate" name="rate" placeholder="Describe your experience..."></textarea>
                                                </div>
                                            </div>
                                            <button class="btn btn-block">Post</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--products sold by this user-->
                    <?php $result=$collection_products->find(["seller" => $user->email]); //find products sold by this user ?>
                    <div class="col-md-6">
                        <h2>Products you sell</h2>
                        <table class="table table-borderedless">
                        <?php foreach ($result as $product) { //show all products in array ?>
                            <tr>
                                <td><img src="<?php echo $product->images->pic1; ?>.jpg"/></td>
                                <td><?php echo $product->name; ?></td>
                                <td><?php echo $product->price; ?></td>
                                <td><a href="edit_product.php?product=<?php echo $product->name ?>"><i class="fa fa-edit"></i></a></td>
                                <td><a href="#delete_product_modal" data-toggle="modal" data-target="#delete_product_modal"><i class="fa fa-close"></i></a></td>
                            </tr>
                        <?php } ?>
                        </table>
                        <!--confirmation deletion of product modal-->
                        <div class="modal" id="delete_product_modal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>Delete Product</h2>
                                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>Are you sure you want to delete "<?php echo $product->name; ?>"?</p>
                                        <button class="btn"><a href="sell.php?action=delete&product=<?php echo $product->name ?>">Yes</a></button>
                                        <button class="btn" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--sell a product, promotion button-->
        <button type="button" class="btn" id="promo"><a href="sell_page.php">+ Sell a Product</a></button>
        <!--footer-->
        <footer class="text-right"> <!--align text to the right-->
            <br><br>
            <button type="button" class="btn btn-outline-dark">Download the app</button>
            <span>&copy; 2021 Thriftie, Second Hand Marketplace</span>
        </footer>
        <!--pass seller as variable to rate modal-->
        <script type="text/javascript">
            $(document).on("click", "#link", function () {
                var seller = $(this).data('seller');
                $("#rate span").text(seller);
                $('#rate').modal('show');
            });
        </script>
     </body>
</html>
