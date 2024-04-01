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
  var course = $("#select-course").val();
  var batch = $("#search-batch").val();
  var trainer = $("#select-trainer").val();
  var status = $("#select-status").val();
  var startDate = $("#start-date").val();
  var endDate = $("#end-date").val();

  $.ajax({
    url: "views/Trainings/table.php",
    type: "POST",
    data: {
      course: course,
      batch: batch,
      trainer: trainer,
      status: status,
      startDate: startDate,
      endDate: endDate,
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
