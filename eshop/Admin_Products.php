<?php
    include 'config.php';

    session_start();
    $products = $collection_products->find()
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
            <p>Products</p>
            <div class="dropdown text-right"> <!--shopping cart/ login butttons-->
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
        <section id="admin_product">
            <p>Total Products: <?php echo $collection_products->count(); //count all products?></p>
            <div class="container">
                <div class="row justify-content-center">
                    <table id="1" class="table table-borderedless">
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Seller</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php $i=0;
                            foreach ($products as $product) { ?>
                        <tr>
                            <td><?php echo $product->_id; ?></td>
                            <td><?php echo $product->name; ?></td>
                            <td><?php echo $product->seller; ?></td>
                            <td><a href="" data-toggle="modal" data-target="#delete_product_modal<?php echo $i; ?>"><i class="fa fa-close"></i></a></td>
                            <td><a href="" data-toggle="modal" data-target="#admin_product_update<?php echo $i; ?>"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        <div class="modal" id="admin_product_update<?php echo $i; ?>" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10">
                                                <div class="card-body text-center">
                                                    <h3>Edit product data</h3>
                                                    <form method="POST" action="sell.php?action=admin">
                                                        <div class="form-outline">
                                                            <label class="form-label" for="admin_id">ID</label>
                                                            <input type="text" class="form-control" id="admin_id" name="admin_id" value="<?php echo $product->_id; ?>" readonly/>
                                                        </div>
                                                        <div class="form-outline">
                                                            <label class="form-label" for="admin_name">Name</label>
                                                            <input type="email" class="form-control" id="admin_name" name="admin_name" value="<?php echo $product->name; ?>" readonly/>
                                                        </div>
                                                        <div class="form-outline">
                                                            <label class="form-label" for="admin_description">Description</label>
                                                            <textarea class="form-control" cols="34" rows="3" id="admin_description" name="admin_description" readonly><?php echo $product->description; ?></textarea>
                                                        </div>
                                                        <div class="form-outline">
                                                            <label class="form-label" for="admin_price">Price</label>
                                                            <input type="text" class="form-control" id="admin_price" name="admin_price" value="<?php echo $product->price; ?>" readonly/>
                                                        </div>
                                                        <div class="form-outline">
                                                            <label class="form-label" for="admin_seller">Seller</label>
                                                            <input type="text" class="form-control" id="admin_seller" name="admin_seller" value="<?php echo $product->seller; ?>" readonly/>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_size">Size:</label>
                                                                    <span class="badge badge-secondary"><?php echo $product->size; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_fit">Fit:</label>
                                                                    <span class="badge badge-secondary"><?php echo $product->fit; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_material">Material:</label>
                                                                    <?php foreach ($product->materials as $material) { ?>
                                                                        <span class="badge badge-secondary"><?php echo $material ?></span>
                                                                   <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-outline">
                                                            <label class="form-label" for="admin_category">Category</label>
                                                            <select class="form-select" id="admin_category" name="admin_category">
                                                                <?php if ($product->category == 'clothes') { ?>
                                                                    <option value="clothes" selected>Clothes</option>
                                                                    <option value="shoes">Shoes</option>
                                                                    <option value="accessories">Accessories</option>
                                                                    <option value="bags">Bags</option>
                                                               <?php } elseif ($product->category == 'shoes') { ?>
                                                                    <option value="clothes">Clothes</option>
                                                                    <option value="shoes" selected>Shoes</option>
                                                                    <option value="accessories">Accessories</option>
                                                                    <option value="bags">Bags</option>
                                                               <?php } elseif ($product->category == 'accessories') { ?>
                                                                    <option value="clothes">Clothes</option>
                                                                    <option value="shoes">Shoes</option>
                                                                    <option value="accessories" selected>Accessories</option>
                                                                    <option value="bags">Bags</option>
                                                               <?php } elseif ($product->category == 'bags') { ?>
                                                                    <option value="clothes">Clothes</option>
                                                                    <option value="shoes">Shoes</option>
                                                                    <option value="accessories">Accessories</option>
                                                                    <option value="bags" selected>Bags</option>
                                                               <?php } else { ?>
                                                                    <option value="0">     </option>
                                                                    <option value="clothes">Clothes</option>
                                                                    <option value="shoes">Shoes</option>
                                                                    <option value="accessories">Accessories</option>
                                                                    <option value="bags">Bags</option>
                                                               <?php } ?>
                                                            </select>
                                                        </div>
                                                        <button class="btn" type="submit">Edit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--confirmation deletion of product modal-->
                        <div class="modal" id="delete_product_modal<?php echo $i; ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Delete Product</h2>
                                                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Product "<?php echo $product->name; ?>" is about to be deleted.</p>
                                                    <button class="btn"><a href="sell.php?action=delete&product=<?php echo $product->name ?>">Continue</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php $i++; } ?>
                    </table>
                </div>
            </div>
        </section>
        <!--footer-->
        <footer class="text-right"> <!--align text to the right-->
            <br><br>
            <span>&copy; 2021 Thriftie, Second Hand Marketplace Admins</span>
        </footer>
    </body>
</html>
