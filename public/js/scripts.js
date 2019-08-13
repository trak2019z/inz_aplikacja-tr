$(document).ready(function(){

    $("#searchInput").keyup(function () {
        var rows = $("#fbody").find("tr").hide();
        if (this.value.length) {
            var data = this.value.split(" ");
            $.each(data, function (i, v) {
                rows.filter(":contains('" + v + "')").show();
            });
        } else rows.show();
    });

    $('.remove-record').click(function() {
		var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var name = $(this).attr('data-name');
        $(".remove-record-model").attr("action",url);
        $('body').find('.modal-name').text(name);
		$('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    });

    $('.remove-data-from-delete-form').click(function() {
        $('body').find('.modal-name').text("");
		$('body').find('.remove-record-model').find( "input" ).remove();
	});

  var getHeight = $('#getHeight').height();
  $('#events').css('height', (getHeight+50) + 'px');


  //mobile nav
  $('#showNav').click(function(e){
    e.preventDefault();
    $(".sidebarMobileScroll").fadeIn();
    $("#sidebar").animate({"left":"0"},350);
    $("#fixedBackground").fadeIn();
  });

  $('#hideNav, #fixedBackground').click(function(e){
    e.preventDefault();
    $("#sidebar").animate({"left":"-240px"},350);
    $(".sidebarMobileScroll").fadeOut();
    $("#fixedBackground").fadeOut();
  });
});
