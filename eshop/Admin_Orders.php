<?php
    include 'config.php';

    session_start();
    $users= $collection_users->find()
?>

<html>
    <head>
        <title>Thriftie Marketplace Administration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--favicon-->
		<link rel="shortcut icon" href="favicon.png"/>
        <!--cart/user login signs-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--import css file-->
        <link rel="stylesheet" href="style.css?v=1" type="text/css">
        <!--import JavaScript functions-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar">
            <!--navigation bar, header-->
            <div class="navbar-header">
                <a href="Admin_Home.php">
                    <img src="logo.png" id="logo"> <!--logo-->
                    <br>
                    <span>Next Generation of Thrifting</span> <!--caption-->
                </a>
            </div>
            <div class="nav">
                <!--navigation bar, links-->
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="Admin_Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin_Users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin_Products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Admin_Orders.php">Orders</a>
                    </li>
                </ul>
            </div>
        </nav>
        <section id="presection">
            <p>Orders</p>
            <div class="dropdown  text-right"> <!--shopping cart/ login butttons-->
                <button class="btn"><a href="#" data-toggle="modal" data-target="#logout_modal">Log out</a></button>
                <br><br>
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
        <section id="admin_home">
            <?php $sum=0;  //count orders of each user
            $users = $users->toArray();
            foreach ($users as $user) { //for each user
                if (!str_contains($user->email, 'admin') AND ($user->email != "not_logged")) {  //except admins
                    foreach ($user->orders as $order) {  //for each order
                        foreach ($order as $item) {  //for each item in order
                            if (gettype($item) != 'object') {
                                $sum++;
                            }
                        }
                    }
                }
            } ?>
            <p>Total Orders: <?php echo $sum ?></p>
            <div class="container">
                <div class="row justify-content-center">
                    <table id="1" class="table table-borderedless">
                        <tr>
                            <th>Order</th>
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>Total Cost</th>
                            <th></th>
                        </tr>
                        <?php $i=0;
                            foreach ($users as $user) {
                                if (!str_contains($user->email, 'admin') AND ($user->email != "not_logged")) {
                                    foreach ($user->orders as $order) {
                                        foreach ($order as $item) {
                                            if (gettype($item) != 'object') {
                                                $product = $collection_products->FindOne(["name" => $item]); //find each product?>
                                                <tr>
                                                    <td><?php echo $item; ?></td>
                                                    <td><?php echo $user->name ?></td>
                                                    <td><?php echo $product->seller; ?></td>
                                                    <td><?php echo $product->price; ?></td>
                                                    <td><a href="" data-toggle="modal" data-target="#cancel_order_modal<?php echo $i; ?>"><i class="fa fa-close"></i></a></td>
                                                </tr>
                                                <!--confirmation deletion of order modal-->
                                                <div class="modal" id="cancel_order_modal<?php echo $i; ?>" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2>Cancel Order</h2>
                                                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <p>Order from "<?php echo $product->seller; ?>" to "<?php echo $user->name; ?>" is about to be cancelled.</p>
                                                                <button class="btn"><a href="cancel_order.php?product=<?php echo $product->name ?>&user=<?php echo $user->email ?>">Continue</a></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                <?php $i++;} } } } ?>
                        <?php  } ?>
                    </table>
                </div>
            </div>
        </section>
        <!--footer-->
        <footer class="text-right">
            <br><br>
            <span>&copy; 2021 Thriftie, Second Hand Marketplace Admins</span>
        </footer>
    </body>
</html>
