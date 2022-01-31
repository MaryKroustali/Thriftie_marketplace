<?php

    include 'config.php'; //connect to db

    //get all products
    session_start(); //check if user is logged in
    if (isset($_SESSION['log']) && $_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    } else { //if no user logged in use an anonynous user
        $user = $collection_users->findOne(["email" => "not_logged"]);
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
        <link rel="stylesheet" href="style.css?" type="text/css">
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
                        <a class="nav-link" class="dropdown-toogle" data-toggle="dropdown" href="Home.php">Shop<span class="caret"></span></a>
                        <div class="dropdown-menu">
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
                    <form  class="form-inline" role="search" action="search.php" method="POST">  <!--search bar-->
                        <input type="text" class="form-control" placeholder="Search..." name="search"/>
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </form>
                </ul>
            </div>
        </nav>
        <section id="presection">
            <p>About Us</p>
            <div class="dropdown  text-right"> <!--shopping cart/ login butttons-->
                <button class="btn" data-toggle="modal" data-target="#cart_modal"><i class="fa fa-shopping-bag"></i> Cart</button>
                <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true) { ?>
                    <button class="btn"><a href="user.php"><i class="fa fa-user"></i> Profile</a></button>
                    <button class="btn"><a href="logout.php">Log out</a></button>
                <?php } else { ?>
                    <button class="btn" data-toggle="modal" data-target="#login_modal"><i class="fa fa-user"></i> Sign In</button>
                <?php } ?>
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
                                                        <input type="text" class="form-control" id="card_expire">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="card_cvv">CVV</label>
                                                        <input type="text" class="form-control" id="card_cvv" maxlength="3">
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
        <section id="about">
            <div class="col">
                <h4>Keep Commerce Human</h4>
                <p>In a time of increasing automation, it’s our mission to keep human connection at the heart of commerce. 
                   That’s why we built a place that is powered by people.
                   We help our community of sellers turn their clothes and accessories into successful businesses. <br>
                   Our platform connects them with millions of buyers looking for alternative, classic or special ideas for dressing up. 
                   As a company, we strive to lead with our guiding principles and to help spread ideas of sustainability and responsibility whose impact can reach far beyond our own business.</p>
            </div>
            <div class="col">
                <h4>How it Works</h4>
                <p>
                    Our global marketplace is a vibrant community of real people connecting over special goods. 
                    The platform empowers sellers to sell clothes they don't need and inspires buyers to buy cheap and alternative clothes through an eco-friendly way. <br>
                    With low fees, powerful tools, and support and education, we help creative entrepreneurs start, manage, and scale their businesses. 
                    From the specific to the unexpected (or custom-made), our search tools help buyers explore all the special one-of-a-kind items offered by sellers. 
                    We provide the technology behind this marketplace, helping buyers and sellers connect and exchange goods. 
                    Keeping those connections safe, fun and secure is our priority, and we’re always here to help. <br>
                    All it takes to become a seller is 20 cents to get started. 

                </p>
            </div>
            <div class="col">
                <h4>Contact us</h4>
                <p>
                    We love hearing from you. We would like you to share compelling, unique stories with us. Share your shopping/selling experiences on Thriftie via email. <br>
                    If you’re a member of the media and would like to talk, please get in touch with out team or send an email to <a href="mailto:thriftie@marketplace.com">thriftie@marketplace.com</a>. <br>
                    If you’re an seller or shopper and have a question about the site, please visit our <a href="Help Center.html">Help Center</a>.
                </p>
            </div>
        </section>
        <!--newsletter-->
        <section id="feedback">
            <h1>Feedback</h1>
            <div class="form">
                <p class="text-center">Rate your experience at Thriftie.</p>
                <div class="rating text-center">
                    <input type="radio" name="rating" value="5" id="5">
                    <label for="5">☆</label>
                    <input type="radio" name="rating" value="4" id="4">
                    <label for="4">☆</label>
                    <input type="radio" name="rating" value="3" id="3">
                    <label for="3">☆</label>
                    <input type="radio" name="rating" value="2" id="2">
                    <label for="2">☆</label>
                    <input type="radio" name="rating" value="1" id="1">
                    <label for="1">☆</label>
                </div>
                <div class="text-center">
                    <div class="form-outline">
                        <textarea class="form-control" rows="3" placeholder="Describe more..."></textarea>
                        <button class="btn btn-block" data-toggle="modal" data-target="#msg">Send</button>
                    </div>
                </div>
            </div>
            <!--modal for successful message-->
            <div class="modal" id="msg" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Thank you</h2>
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                        </div>
                        <div class="modal-body text-center">
                            <h3>We appreciate you rating us.<br>
                                Contact as <a href="help center.html#contact">here</a> in you need anything!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--footer-->
        <footer class="text-right"> <!--align text to the right-->
            <br><br>
            <button type="button" class="btn btn-outline-dark">Download the app</button>
            <span>&copy; 2021 Thriftie, Second Hand Marketplace</span>
        </footer>
    </body>
</html>