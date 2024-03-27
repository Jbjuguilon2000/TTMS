$(function () {
  table();
});

function table() {
  $("#table-loader").show();

  $.ajax({
    url: "views/Employees/table.php",
    type: "GET",
    data: {},
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
