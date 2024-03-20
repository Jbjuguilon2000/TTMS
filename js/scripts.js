$(function () {
  Dashboards();
});

$(".navbar-nav > .nav-item > .navbtn").on("click", function (e) {
  $(".navbar-nav > .nav-item > .navbtn").removeClass("active");
  $(this).toggleClass("active");
});

function Dashboards() {
  $("#loader").show();

  $.ajax({
    url: "views/Dashboards/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
}

function Employees() {
  $("#loader").show();

  $.ajax({
    url: "views/Employees/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
}

function Trainings() {
  $("#loader").show();

  $.ajax({
    url: "views/Trainings/index.php",
    type: "GET",
    success: function (response) {
      $("#loader").hide();
      $("#main").html(response);
    },
    error: function () {
      $("#loader").hide();
      $("#main").html("Error occurred. Please try again.");
    },
  });
}

