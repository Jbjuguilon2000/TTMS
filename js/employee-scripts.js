$(function () {
  table();
  $(document).on("click", ".page-item", function () {
    var page = $(this).attr("id");
    table(page);
  });
});

function table(page) {
  $("#table-loader").show();
  $.ajax({
    url: "views/Employees/table.php",
    type: "POST",
    data: {
      page: page,
    },
    success: function (response) {
      $("#table-loader").hide();
      $("#table").html(response);
    },
    error: function () {
      $("#table-loader").hide();
      $("#table").html("Error occurred. Please try again.");
    },
  });
}

function view(id) {
  $("#view-loader").show();
  $("#hiddenID").val(id);
  $.ajax({
    url: "views/Employees/view.php",
    type: "POST",
    data: {
      ID: id,
    },
    success: function (response) {
      $("#view-loader").hide();
      $("#view").html(response);
    },
    error: function () {
      $("#view-loader").hide();
      $("#view").html("Error occurred. Please try again.");
    },
  });
}
