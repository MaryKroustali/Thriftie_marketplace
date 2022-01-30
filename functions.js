//pass seller name to action post php file
function seller () {
    var seller = document.getElementById("seller").innerHTML;
    var user = document.getElementById("user_name").innerHTML;
    document.getElementById("form").action = 'rate_seller.php?user='+user+'&seller='+seller;
}
