var isIdle = false;
var idleTimer;

// Function to reset the idle state
function resetIdle() {
  if (isIdle) {
    isIdle = false;
  }

  clearTimeout(idleTimer);
  idleTimer = setTimeout(() => {
    isIdle = true;
    table(); // Refresh the table when user is idle for 1 minute
  }, 60000); // 1 minute in milliseconds
}

// Event listeners to track user activity
$(document).on("mousemove", resetIdle);
$(document).on("keypress", resetIdle);

// Initial setup
resetIdle();

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

function printForm() {
  var id = $("#hiddenID").val();
  $.ajax({
    url: "views/Employees/print/print.php",
    type: "POST",
    data: {
      ID: id,
    },
    success: function (response) {
      $("#view-loader").hide();
      $("#Printer").html(response);
      $("#Printer").attr("class", "d-none d-print-block");
      setTimeout(() => {
        window.print();
      }, 300);
    },
    error: function () {
      $("#view-loader").show();
    },
  });
}
