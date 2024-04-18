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

  var TrainerIDArray = [];
  var TrainerNameArray = [];
  var DivisionIDArray = [];
  var DivisionNameArray = [];
  var SubjectIDArray = [];
  var SubjectNameArray = [];

  $(document).ready(function () {
    $("#createTrainingModal").on("hidden.bs.modal", function () {
      $(this).find("form")[0].reset();
      TrainerIDArray = [];
      TrainerNameArray = [];
      DivisionIDArray = [];
      DivisionNameArray = [];
      SubjectIDArray = [];
      SubjectNameArray = [];
      $(this).find("form").removeClass("was-validated");
    });

    handleCheckbox(".cb_trnr", "#c_trainers", "#select_trainers");
    handleCheckbox(".cb_dvsn", "#c_divisions", "#select_divisions");
    handleCheckbox(".cb_sbjct", "#c_subjects", "#select_subjects");
  });

  $("#updateTrainingModal").on("hidden.bs.modal", function () {
    $(this).find("form")[0].reset();
    $(this).find("form").removeClass("was-validated");
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

function createTrainingFormValidation(event) {
  var form = $("#createTrainingModal form");
  if (form[0].checkValidity() === false) {
    event.preventDefault();
    event.stopPropagation();
  }
  form.addClass("was-validated");

  if (form[0].checkValidity() === true) {
    create();
  }
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
      $("#createTrainingModal").modal("hide");
    },
    error: function (response) {
      console.log(response);
    },
  });
}

function read(tID) {
  $("#hiddenTrainingID").val(tID);
  $.ajax({
    url: "views/Trainings/crud.php",
    type: "POST",
    data: { read: true, ID: tID },
    success: function (response) {
      var data = JSON.parse(response)[0];
      updateFormField("#u_course", data.CourseID);
      updateFormField("#u_batch", data.BatchNo);
      updateFormField("#u_subjects", data.SubjectID);
      updateFormField("#u_startdate", data.StartDate);
      updateFormField("#u_enddate", data.EndDate);
      updateFormField("#u_status", data.StatusID);
      updateFormField("#u_trainers", data.TrainerID);
      updateFormField("#u_divisions", data.DivisionID);
      updateFormField("#u_remarks", data.Remarks);

      updateHandleCheckbox(".ucb_trnr", "#u_trainers", "#update_trainers");
      updateHandleCheckbox(".ucb_dvsn", "#u_divisions", "#update_divisions");
      updateHandleCheckbox(".ucb_sbjct", "#u_subjects", "#update_subjects");
    },
  });
}

function updateFormField(selector, value) {
  $(selector).val(value);
}

function handleCheckbox(checkboxSelector, fieldSelector, updateFieldSelector) {
  var values = [];
  var nameArray = [];
  $(checkboxSelector).on("click", function () {
    if (this.checked) {
      values.push(this.value);
      nameArray.push(this.getAttribute("name"));
    } else {
      values = values.filter((e) => e !== this.value);
      nameArray = nameArray.filter((e) => e !== this.getAttribute("name"));
    }
    $(fieldSelector).val(values.join(","));
    $(updateFieldSelector).val(nameArray.join(", "));
  });
}

function updateHandleCheckbox(
  checkboxSelector,
  fieldSelector,
  updateFieldSelector
) {
  var values = $(fieldSelector).val().split(",");
  var nameArray = [];
  $(checkboxSelector).each(function () {
    if (values.includes($(this).val())) {
      $(this).prop("checked", true);
      nameArray.push(this.getAttribute("name"));
      $(updateFieldSelector).val(nameArray.join(", "));
    } else {
      $(this).prop("checked", false);
    }
  });

  $(checkboxSelector).on("click", function () {
    if (this.checked) {
      values.push(this.value);
      nameArray.push(this.getAttribute("name"));
    } else {
      values = values.filter((e) => e !== this.value);
      nameArray = nameArray.filter((e) => e !== this.getAttribute("name"));
    }
    $(fieldSelector).val(values.join(","));
    $(updateFieldSelector).val(nameArray.join(", "));
  });
}

function updateTrainingFormValidation(event) {
  var form = $("#updateTrainingModal form");
  if (form[0].checkValidity() === false) {
    event.preventDefault();
    event.stopPropagation();
  }
  form.addClass("was-validated");

  if (form[0].checkValidity() === true) {
    update();
  }
}

function update(page) {
  var get_id = $("#hiddenTrainingID").val();
  var get_course = $("#u_course").val();
  var get_batch = $("#u_batch").val();
  var get_subjects = $("#u_subjects").val();
  var get_startdate = $("#u_startdate").val();
  var get_enddate = $("#u_enddate").val();
  var get_status = $("#u_status").val();
  var get_trainers = $("#u_trainers").val();
  var get_divisions = $("#u_divisions").val();
  var get_remarks = $("#u_remarks").val();

  $.ajax({
    url: "views/Trainings/crud.php",
    type: "POST",
    data: {
      update: true,
      id: get_id,
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
      table(page);
      $("#updateTrainingModal").modal("hide");
    },
    error: function (response) {
      console.log(response);
    },
  });
}
