<?php
    session_start(); //create session
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
                            <a class="dropdown-item" href="#">All products</a>
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
            <div class="dropdown"> <!--shopping cart/ login butttons-->
                <button class="btn" data-toggle="modal" data-target="#cart_modal"><i class="fa fa-shopping-bag"></i> Cart</button>
                <button class="btn"><i class="fa fa-user"></i> <a href="logout.php">Log out</a></button>
            </div>
        </section>
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
        <section id="user">
            <h1>Your Profile</h1>
            <div class="card border-0">
                <div class="row">
                    <div class="col-md-2">
                        <img src="favicon.png" class="card-img">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $json->name; ?></h2>
                            <p class="card-text">Email: <span><?php echo $json->email; ?></span><a href="#email_update" data-target="#email_update" data-toggle="modal"><i class="fa fa-edit"></i></a></p>
                            <p class="card-text">Location: <span><?php echo $json->location; ?></span><a href="#location_update" data-target="#location_update" data-toggle="modal"><i class="fa fa-edit"></i></a></p>
                            <p><a class="card-text" href="#pass_update" data-target="#pass_update" data-toggle="modal">Change my password</a></p>
                            <label style="font-weight:10" class="card-text">
                                Describe yourself as a seller:
                                <a href="update_user.php?action=description">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </label>
                            <textarea cols="34" rows="4" id="descr_sign" name="sign_descr">Description for a seller</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center">For further help, please <a href="help center.html#contact">contact us here</a>.</p>
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
                                        <form method="POST" action="update_user.php">
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
                                        <form method="POST" action="update_user.php" oninput='confirm_new.setCustomValidity(confirm_new.value != new_pass.value ? "Passwords do not match." : "")'>
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
        <section id="favorites">
            <h1>Favorites</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderedless">
                            <tr>
                                <td><a href="home.html#item1"><img src="items/item1.jpg"/></a></td>
                                <td><a href="#">Organic Handmade Striped Dress</a></td>
                                <td>14.60$</td>
                                <td><button><i class="fa fa-heart"></i></button></td>
                                <td><button><i class="fa fa-shopping-bag"></i></button></td>
                            </tr>
                            <tr>
                                <td><a href="#"><img src="items/item7.jpg"/></a></td>
                                <td><a href="#">Beaded Silver Necklace</a></td>
                                <td>13.00$</td>
                                <td><button><i class="fa fa-heart"></i></button></td>
                                <td><button><i class="fa fa-shopping-bag"></i></button></td>
                            </tr>
                            <tr>
                                <td><a href="#"><img src="items/item8.jpg"/></a></td>
                                <td><a href="#">Leather Shoulder bag</a></td>
                                <td>23.00$</td>
                                <td><button><i class="fa fa-heart"></i></button></td>
                                <td><button><i class="fa fa-shopping-bag"></i></button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section id="history">
            <h1>History</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Your Orders</h2>
                        <table class="table table-borderedless">
                            <tr>
                                <td><a href="#order_modal" data-toggle="modal" data-target="#order_modal"><img src="items/item1.jpg" style="opacity: 0.5"/></a></td>
                                <td><a href="#order_modal" data-toggle="modal" data-target="#order_modal"><span>17</span> Items</a></td>
                                <td>Total: <span>14.60$</span></td>
                            </tr>
                            <tr>
                                <td><a href="#order_modal" data-toggle="modal" data-target="#order_modal"><img src="items/item7.jpg" style="opacity: 0.5"/></a></td>
                                <td><a href="#order_modal" data-toggle="modal" data-target="#order_modal"><span>2</span> Items</a></td>
                                <td>Total: <span>13.00$</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h2>Products you sold</h2>
                        <!--TO DO redirect to sell product page-->
                        <table class="table table-borderedless">
                            <tr>
                                <td><a href="#"><img src="items/item1.jpg"/></a></td>
                                <td><a href="#">Organic Handmade Striped Dress</a></td>
                                <td>14.60$</td>
                            </tr>
                            <tr>
                                <td><a href="#"><img src="items/item7.jpg"/></a></td>
                                <td><a href="#">Beaded Silver Necklace</a></td>
                                <td>13.00$</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="modal" id="order_modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="modal-body text-center">
                            <h3>Order</h3>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--TO DO add data from db-->
                                        <table class="table table-borderedless">
                                            <tr>
                                                <td><img src="items/item1.jpg"/></td>
                                                <td>Organic Handmade Striped Dress</td>
                                                <td>14.60$</td>
                                            </tr>
                                            <tr>
                                                <td><img src="items/item7.jpg"/></td>
                                                <td>Beaded Silver Necklace</td>
                                                <td>13.00$</td>
                                            </tr>
                                            <tr>
                                                <td><img src="items/item8.jpg"/></td>
                                                <td>Leather Shoulder bag</td>
                                                <td>23.00$</td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <!--TO DO fix total with js-->
                                        <p>Total <span>   10</span>$</p>
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