$(".ic-tab-link").on("click", function (e) {
  e.preventDefault();
  $(".ic-tab-link").removeClass("active");
  $(this).addClass("active");
  let itemClass = $(this).data("tabs");
  $(".ic__ourFeature--tabs").hide();
  $("#" + itemClass).fadeIn();
});

