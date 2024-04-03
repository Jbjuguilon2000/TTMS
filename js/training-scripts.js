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

function view(tID) {
  $.ajax({
    url: "views/Trainings/view.php",
    type: "POST",
    data: {
      ID: tID,
    },
    success: function (response) {
      $("#table-loader").hide();
      $(".training-page").html(response);
    },
    error: function () {
      $("#table-loader").show();
    },
  });
}

function files(tID) {
  $.ajax({
    url: "views/Trainings/files.php",
    type: "POST",
    data: {
      ID: tID,
    },
    success: function (response) {
      $("#table-loader").hide();
      $(".training-page").html(response);
    },
    error: function () {
      $("#table-loader").show();
    },
  });
}

function create() {
  var get_course = $("#c_course").val();
  var get_batch = $("#c_batch").val();
  var get_subjects = $("#c_subjects").val();
  var get_startdate = $("#c_startdate").val();
  var get_enddate = $("#c_enddate").val();
  var get_status = $("#c_status").val();
  var get_trainers = $("#c_trainers").val();
  var get_divisions = $("#c_divisions").val();
  var get_remarks = $("#c_remarks").val();

  $.ajax({
    url: "views/Trainings/crud.php",
    type: "POST",
    data: {
      create: true,
      course: get_course,
      batch: get_batch,
      subjects: get_subjects,
      startdate: get_startdate,
      enddate: get_enddate,
      status: get_status,
      trainers: get_trainers,
      divisions: get_divisions,
      remarks: get_remarks,
    },
    success: function (response) {
      console.log(response);
      table();
    },
    error: function (response) {
      console.log(response);
    },
  });
}

function read(tID) {
  $.ajax({
    url: "views/Trainings/crud.php",
    type: "POST",
    data: {
      read: true,
      ID: tID,
    },
    success: function (response) {
      var get = JSON.parse(response)[0];
      $("#u_course").val(get.CourseID);
      $("#u_batch").val(get.BatchNo);
      $("#u_subjects").val(get.SubjectID);
      $("#u_startdate").val(get.StartDate);
      $("#u_enddate").val(get.EndDate);
      $("#u_status").val(get.StatusID);
      $("#u_trainers").val(get.TrainerID);
      $("#u_divisions").val(get.DivisionID);
      $("#u_remarks").val(get.Remarks);
    },
  });
}
