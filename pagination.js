$(document).ready (function () {

        var pageSize = 4; //8 items per page
        var pageFull = $name;
        var pageNumber = 2;  //get products/8

        for (i = 0;i < pageNumber;i++) {
            var pageNum = i+1;
            if (i == 0) {
                $('.pagination').append ('<li class="page-item active"><a class="page-link" rel="'+0+'" href="#">'+pageNum+'</a></li>'); //add first active page button
            } else {
                $('.pagination').append ('<li class="page-item"><a class="page-link" rel="'+i+'" href="#">'+pageNum+'</a></li>'); //add page buttons
            }
        }

        $('.card').hide();
        $('.card').slice(0,4).show(); //show first 8 products
        $('.pagination li a').not('.previous, .next').bind('click', function() {  //when page buttons are clicked
                $('.card').hide(); //hide all products
                $('.pagination li').removeClass('active');
                $(this).parent().addClass('active'); //current page active
                var currPage = $(this).attr('rel'); //get page
                var startItem = currPage * pageSize;  //starting item = page*8
                var endItem = startItem + pageSize;   //ending item = page*8 + next 8 items
                $('.card').slice(startItem, endItem).show(); //show next 8

                if ($(this).prev().parent().hasClass('previous')) {
                    $(this).prev().addClass('disabled'); //current page active
                }
            });

})