$(document).ready (function () {

        var pageSize = 8; //8 items per page

        $('.card').hide();
        $('.card').slice(0,8).show(); //show first 8 products
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
