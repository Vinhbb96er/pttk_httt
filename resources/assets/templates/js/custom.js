

$(document).ready(function(){

   $(".has_sub > a").click(function(e){
    e.preventDefault();
    var menu_li = $(this).parent("li");
    var menu_ul = $(this).next("ul");

    if(menu_li.hasClass("open")){
      menu_ul.slideUp(350);
      menu_li.removeClass("open")
    }
    else{
      $("#nav > li > ul").slideUp(350);
      $("#nav > li").removeClass("open");
      menu_ul.slideDown(350);
      menu_li.addClass("open");
    }
  });

/* Old Code 

  $("#nav > li > a").on('click',function(e){
      if($(this).parent().hasClass("has_sub")) {
       
		  e.preventDefault();

		  if(!$(this).hasClass("subdrop")) {
			// hide any open menus and remove all other classes
			$("#nav li ul").slideUp(350);
			$("#nav li a").removeClass("subdrop");
			
			// open our new menu and add the open class
			$(this).next("ul").slideDown(350);
			$(this).addClass("subdrop");
		  }
		  
		  else if($(this).hasClass("subdrop")) {
			$(this).removeClass("subdrop");
			$(this).next("ul").slideUp(350);
		  } 
      }   
      
  }); */
});

$(document).ready(function(){
  $(".sidebar-dropdown a").on('click',function(e){
      e.preventDefault();

      if(!$(this).hasClass("open")) {
        // open our new menu and add the open class
        $(".sidebar #nav").slideDown(350);
        $(this).addClass("open");
      }
      
      else{
        $(".sidebar #nav").slideUp(350);
        $(this).removeClass("open");
      }
  });

});

/* Widget close */

$('.wclose').click(function(e){
  e.preventDefault();
  var $wbox = $(this).parent().parent().parent();
  $wbox.hide(100);
});

/* Widget minimize */

$('.wminimize').click(function(e){
	e.preventDefault();
	var $wcontent = $(this).parent().parent().next('.widget-content');
	if($wcontent.is(':visible')) 
	{
	  $(this).children('i').removeClass('fa fa-chevron-up');
	  $(this).children('i').addClass('fa fa-chevron-down');
	}
	else 
	{
	  $(this).children('i').removeClass('fa fa-chevron-down');
	  $(this).children('i').addClass('fa fa-chevron-up');
	}            
	$wcontent.toggle(500);
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function () {
    $('.pagination').addClass('pagination-sm pull-right');
    $('.alert').delay(2500).hide('800');

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img-upload").on('change' , function() {
        readURL(this);
    });

    // lock-actice staff
    $('#lock-staff').on('click', function () {
        var status = $(this).attr('val');
        var staffId = $(this).attr('data-staff');
        var url = $(this).attr('data-url');

        $.ajax({
            url: url,
            method: 'POST',
            type: 'json',
            data: {
                status: status,
                staffId: staffId,
            },
            success: function (data) {
                if (data.success) {
                    $('#staff-status').removeClass('status-0');
                    $('#staff-status').removeClass('status-1');
                    $('#staff-status').addClass('status-' + data.status);
                    $('#staff-status').text(data.content);
                
                    $('#lock-staff').removeClass('btn-lock-0');
                    $('#lock-staff').removeClass('btn-lock-1');
                    $('#lock-staff').addClass('btn-lock-' + data.status);
                    $('#lock-staff').attr('val', data.status)

                    if (data.status) {
                        $('#lock-staff').text('Khóa');
                    } else {
                        $('#lock-staff').text('Mở khóa');
                    }
                }
            }
        });
    });

    // search staff
    $('#search-box').on('keyup', function () {
        var searchData = $(this).val();
        var condition = $('#condition-search').val();
        var url = $(this).attr('data-url');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                searchData: searchData,
                condition: condition,
            },
            success: function (data) {
                $('#show-data').html(data);
            }
        });
    });

    $('#condition-search').on('change', function () {
        var searchData = $('#search-box').val();
        var condition = $(this).val();
        var url = $('#search-box').attr('data-url');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                searchData: searchData,
                condition: condition,
            },
            success: function (data) {
                $('#show-data').html(data);
            }
        });
    });

    // delete all staff
    $('.checkbox-delete-all').on('click', function () {
        var check = $(this).prop('checked');

        $('.checkbox-delete').each(function () {
            $(this).prop('checked', check ? 'checked' : '');
        });
    });

    $('.checkbox-delete').on('click', function () {
        var checks = [];

        $('.checkbox-delete').each(function () {
            if ($(this).prop('checked')) {
                checks.push(1);
            }
        });

        if (checks.length == 0 || checks.length != $('.checkbox-delete').length) {
            $('.checkbox-delete-all').prop('checked', '');
        } else if (checks.length == $('.checkbox-delete').length) {
            $('.checkbox-delete-all').prop('checked', 'checked');
        }
    });

    $('#delete-all-btn').on('click', function () {
        var dataId = [];
        var url = $(this).attr('data-url');

        $('.checkbox-delete').each(function () {
            if ($(this).prop('checked')) {
                dataId.push($(this).attr('val'));
            }
        });

        if (!dataId.length) {
            alert('Bạn chưa chọn dòng để xóa!')
            return false;
        }

        if (!confirm('Bạn có chắc chắn muốn xóa dòng đã chọn và toàn bộ dữ liệu liên quan?')) {
            return false;
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                dataId: dataId
            }, 
            success: function (data) {}
        });
    });
});




/* Date picker */

// $(function() {
//     $('#datetimepicker1').datetimepicker({
//       pickTime: false
//     });
// });

// $(function() {
//     $('#datetimepicker2').datetimepicker({
//       pickDate: false
//     });
// });
