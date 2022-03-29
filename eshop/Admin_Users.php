<?php
    include 'config.php';

    session_start();
    $users = $collection_users->find()
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
            <p>Users</p>
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
        <section id="admin_user">
            <p>Total Users: <?php echo $collection_users->count()-2; //count users, exclude admins?></p>
            <div class="container">
                <div class="row justify-content-center">
                    <table id="1" class="table table-borderedless">
                        <tr>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>History</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php $i=0;
                            foreach ($users as $user) {
                                if (!str_contains($user->email, 'admin') AND ($user->email != "not_logged")) { //show all users except of admins?>
                                <tr>
                                    <td><?php echo $user->_id; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->name; ?></td>
                                    <td><a href="" data-toggle="modal" data-target="#session_history"></a></td>
                                    <td><a href="" data-toggle="modal" data-target="#delete_user_modal<?php echo $i ?>"><i class="fa fa-close"></i></a></td>
                                    <td><a href="" data-toggle="modal" data-target="#admin_user_update<?php echo $i ?>"><i class="fa fa-edit"></i></a></td>
                                </tr>
                                <?php } ?>
                                <div class="modal" id="admin_user_update<?php echo $i; ?>" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                            </div>
                                            <div class="modal-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-10">
                                                        <div class="card-body text-center">
                                                            <h3>Edit user data</h3>
                                                            <form method="POST" action="update_user.php?action=admin">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_id">User ID</label>
                                                                    <input type="text" class="form-control" id="admin_id" name="admin_id" value="<?php echo $user->_id; ?>" readonly>
                                                                </div>
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_email">Email</label>
                                                                    <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?php echo $user->email; ?>" readonly/>
                                                                </div>
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_password">Password</label>
                                                                    <input type="password" class="form-control" id="admin_password" name="admin_password" value="<?php echo $user->password; ?>" readonly/>
                                                                </div>
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_name">Name</label>
                                                                    <input type="text" class="form-control" id="admin_name" value="<?php echo $user->name; ?>" name="admin_name"/>
                                                                </div>
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_location">Location</label>
                                                                    <input type="text" class="form-control" id="admin_location" value="<?php echo $user->location; ?>" name="admin_location"/>
                                                                </div>
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="admin_description">Description</label>
                                                                    <textarea class="form-control" cols="34" rows="3" id="sign_description" name="admin_description"><?php echo $user->description; ?></textarea>
                                                                </div>
                                                                <button class="btn btn-block">Edit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--confirmation deletion of user modal-->
                                <div class="modal" id="delete_user_modal<?php echo $i; ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Delete User</h2>
                                                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>  <!--exit button-->
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>User "<?php echo $user->name; ?>" is about to be deleted.</p>
                                                    <button class="btn"><a href="delete_user.php?user=<?php echo $user->email ?>">Continue</a></button>
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
