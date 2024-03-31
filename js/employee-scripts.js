$(function () {
  table();
  $(document).on("click", ".page-item", function () {
    var page = $(this).attr("id");
    table(page);
  });
});

function table(page) {
  var name = $("#search-name").val();
  var designation = $("#select-designation").val();
  var division = $("#select-division").val();

  $.ajax({
    url: "views/Employees/table.php",
    type: "POST",
    data: {
      name: name,
      designation: designation,
      division: division,
      page: page,
    },
    success: function (response) {
      $("#table-loader").hide();
      $("#table").html(response);
    },
    error: function () {
      $("#table-loader").show();
    },
  });
}

function view(id) {
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
      $("#view-loader").show();
    },
  });
}
