$(function () {
  var currentFunction = localStorage.getItem("currentFunction");
  if (currentFunction === "Employees") {
    Employees();
  } else if (currentFunction === "Trainings") {
    Trainings();
  } else if (currentFunction === "FormsEquipment") {
    FormsEquipment();
  } else {
    Dashboards();
  }
});

function Dashboards() {
  $("#loader").show();

  $.ajax({
    url: "views/Dashboards/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
      $(".navbar-nav > .nav-item > .navbtn").removeClass("active");
      $(".navbar-nav > .nav-item > .navbtn[data-target='Dashboards']").addClass(
        "active"
      );
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
  localStorage.setItem("currentFunction", "Dashboards");
}

function Employees() {
  $("#loader").show();

  $.ajax({
    url: "views/Employees/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
      $(".navbar-nav > .nav-item > .navbtn").removeClass("active");
      $(".navbar-nav > .nav-item > .navbtn[data-target='Employees']").addClass(
        "active"
      );
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
  localStorage.setItem("currentFunction", "Employees");
}

function Trainings() {
  $("#loader").show();

  $.ajax({
    url: "views/Trainings/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
      $(".navbar-nav > .nav-item > .navbtn").removeClass("active");
      $(".navbar-nav > .nav-item > .navbtn[data-target='Trainings']").addClass(
        "active"
      );
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
  localStorage.setItem("currentFunction", "Trainings");
}

function FormsEquipment() {
  $("#loader").show();

  $.ajax({
    url: "views/FormsEquipment/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
      $(".navbar-nav > .nav-item > .navbtn").removeClass("active");
      $(
        ".navbar-nav > .nav-item > .navbtn[data-target='FormsEquipment']"
      ).addClass("active");
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
  localStorage.setItem("currentFunction", "FormsEquipment");
}
