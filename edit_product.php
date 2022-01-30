<?php //connect to db

    include 'config.php'; //check logged in user
    session_start();
    if ($_SESSION['log'] == true) {
        $user = $collection_users->findOne(["email" => $_SESSION['username']]);
    }

    $product = $_GET['product'];  //get product name

    //find product in db
    $item = $collection_products->findOne(["name" => $product]);

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
                    <form  class="form-inline" role="search" action="search.php" method="POST">  <!--search bar-->
                        <input type="text" class="form-control" placeholder="Search..." name="search"/>
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </form>
                </ul>
            </div>
        </nav>
        <section id="sell">
            <h1>Edit your product</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Before you sell a product at Thriftie, make sure you have read our <a href="help center.html">policies</a>.</p>
                    </div>
                    <!--fill form with values of product-->
                    <form action="sell.php?action=update&name=<?php echo $item->name; ?>" method="POST" class="col-md-12">
                        <div class="col-lg-5 form-outline col-md-12">
                            <label for="files[]" class="form-label">Upload one or more images</label>
                            <input type="file" class="form-control" name="files[]" id="file" required multiple accept="image/.jpg"/>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="form-outline">
                                <label for="name" class="form-label">Name your product</label>
                                <input class="form-control" type="text" name="name" id="name" value="<?php echo $item->name; ?>" required/>
                            </div>
                            <div class="form-outline">
                                <label for="descr" class="form-label">Add a description</label>
                                <textarea class="form-control" id="descr" name="descr" rows="7" required><?php echo $item->description; ?></textarea>
                            </div>
                            <div class="form-outline">
                                <label for="price" class="form-label">Define your price</label>
                                <input class="form-control" type="number" name="price" id="price" step="0.1" value="<?php echo substr($item->price,1,-1); ?>"required/> <!--exclude dollar sign-->
                            </div>
                            <div>
                                <label for="size" class="form-label">Select size</label>
                                <fieldset>
                                <input type="radio" class="btn-check" name="size" id="xs" value="X Small" autocomplete="off">
                                    <label class="btn btn-secondary" for="xs">X Small</label>
                                    <input type="radio" class="btn-check" name="size" id="s" value="Small" autocomplete="off">
                                    <label class="btn btn-secondary" for="s">Small</label>
                                    <input type="radio" class="btn-check" name="size" id="m" value="Medium" autocomplete="off">
                                    <label class="btn btn-secondary" for="m">Medium</label>
                                    <input type="radio" class="btn-check" name="size" id="l" value="Large" autocomplete="off">
                                    <label class="btn btn-secondary" for="l">Large</label>
                                    <input type="radio" class="btn-check" name="size" id="xl" value="X Large" autocomplete="off">
                                    <label class="btn btn-secondary" for="xl">X Large</label>
                                    <input type="radio" class="btn-check" name="size" id="xxl" value="XX Large" autocomplete="off">
                                    <label class="btn btn-secondary" for="xxl">XX Large</label>
                                    <input type="radio" class="btn-check" name="size" id="one" value="One Size" autocomplete="off">
                                    <label class="btn btn-secondary" for="one">One Size</label>
                                    <!--show selected radio button-->
                                    <?php if ($item->size == "X Small") { ?>
                                    <input type="radio" class="btn-check" name="size" id="xs" value="X Small" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="xs">X Small</label>
                                    <?php } elseif ($item->size == "Small") { ?>
                                    <input type="radio" class="btn-check" name="size" id="s" value="Small" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="s">Small</label>
                                    <?php } elseif ($item->size == "Medium") { ?>
                                    <input type="radio" class="btn-check" name="size" id="m" value="Medium" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="m">Medium</label>
                                    <?php } elseif ($item->size == "Large") { ?>
                                    <input type="radio" class="btn-check" name="size" id="l" value="Large" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="l">Large</label>
                                    <?php } elseif ($item->size == "X Large") { ?>
                                    <input type="radio" class="btn-check" name="size" id="xl" value="X Large" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="xl">X Large</label>
                                    <?php } elseif ($item->size == "XX Large") { ?>
                                    <input type="radio" class="btn-check" name="size" id="xxl" value="XX Large" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="xxl">XX Large</label>
                                    <?php } elseif ($item->size == "One Size") { ?>
                                    <input type="radio" class="btn-check" name="size" id="one" value="One Size" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="one">One Size</label>
                                    <?php } ?>
                                </fieldset>
                            </div>
                            <div>
                                <label for="fit" class="form-label">Describe Fit</label>
                                <fieldset>
                                    <input type="radio" class="btn-check" name="fit" id="over" value="Oversized" autocomplete="off">
                                    <label class="btn btn-secondary" for="over">Oversized</label>
                                    <input type="radio" class="btn-check" name="fit" id="skin" value="Skinny" autocomplete="off">
                                    <label class="btn btn-secondary" for="skin">Skinny</label>
                                    <input type="radio" class="btn-check" name="fit" id="slim" value="Slim" autocomplete="off">
                                    <label class="btn btn-secondary" for="slim">Slim</label>
                                    <input type="radio" class="btn-check" name="fit" id="regular" value="Regular" autocomplete="off">
                                    <label class="btn btn-secondary" for="regular">Regular</label>
                                    <!--show selected radio button-->
                                    <?php if ($item->fit == "Oversized") { ?>
                                    <input type="radio" class="btn-check" name="fit" id="over" value="Oversized" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="over">Oversized</label>
                                    <?php } elseif ($item->fit == "Skinny") { ?>
                                    <input type="radio" class="btn-check" name="fit" id="skin" value="Skinny" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="skin">Skinny</label>
                                    <?php } elseif ($item->fit == "Slim") { ?>
                                    <input type="radio" class="btn-check" name="fit" id="slim" value="Slim" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="slim">Slim</label>
                                    <?php } elseif ($item->fit == "Regular") { ?>
                                    <input type="radio" class="btn-check" name="fit" id="regular" value="Regular" autocomplete="off" checked>
                                    <label class="btn btn-secondary" for="regular">Regular</label>
                                    <?php } ?>
                                </fieldset>
                            </div>
                            <div>
                                <label for="materials[]" class="form-label">Material</label>
                                <fieldset>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="linen" value="Linen" autocomplete="off">
                                    <label class="btn btn-secondary" for="linen">Linen</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="cotton" value="Cotton" autocomplete="off">
                                    <label class="btn btn-secondary" for="cotton">Cotton</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="leather" value="Leather" autocomplete="off">
                                    <label class="btn btn-secondary" for="leather">Leather</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="poly" value="Polyester" autocomplete="off">
                                    <label class="btn btn-secondary" for="poly">Polyester</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="fleece" value="Fleece" autocomplete="off">
                                    <label class="btn btn-secondary" for="fleece">Fleece</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="plastic" value="Plastic" autocomplete="off">
                                    <label class="btn btn-secondary" for="plastic">Plastic</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="silver" value="Silver" autocomplete="off">
                                    <label class="btn btn-secondary" for="silver">Silver</label>
                                    <input type="checkbox" class="btn-check" name="materials[]" id="gold" value="Gold" autocomplete="off">
                                    <label class="btn btn-secondary" for="gold">Gold</label>
                                    <!--show selected checkboxes-->
                                    <?php if (in_array("Linen", (array)$item->materials)) { ?>
                                    <script>document.getElementById("linen").checked = true;</script>
                                    <?php } if (in_array("Cotton", (array)$item->materials,)) { ?>
                                    <script>document.getElementById("cotton").checked = true;</script>
                                    <?php } if (in_array("Leather", (array)$item->materials)) { ?>
                                    <script>document.getElementById("leather").checked = true;</script>
                                    <?php } if (in_array("Polyester", (array)$item->materials)) { ?>
                                    <script>document.getElementById("poly").checked = true;</script>
                                    <?php } if (in_array("Fleece", (array)$item->materials)) { ?>
                                    <script>document.getElementById("fleece").checked = true;</script>
                                    <?php } if (in_array("Plastic", (array)$item->materials)) { ?>
                                    <script>document.getElementById("plastic").checked = true;</script>
                                    <?php } if (in_array("Silver", (array)$item->materials)) { ?>
                                    <script>document.getElementById("silver").checked = true;</script>
                                    <?php } if (in_array("Gold", (array)$item->materials)) { ?>
                                    <script>document.getElementById("gold").checked = true;</script>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block">Update</button>
                    </form>
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