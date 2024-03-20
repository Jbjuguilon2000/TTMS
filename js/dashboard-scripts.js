$(function () {
  chart1();
  chart2();
});

function chart1() {
  $("#chart1-loader").show();

  $.ajax({
    url: "views/Dashboards/chart-1.php",
    type: "GET",
    success: function (response) {
      $("#chart1-loader").hide();
      $("#chart1").html(response);
    },
    error: function () {
      $("#chart1-loader").hide();
      $("#chart1").html("Error occurred. Please try again.");
    },
  });
}

function chart2() {
  $("#chart2-loader").show();

  $.ajax({
    url: "views/Dashboards/chart-2.php",
    type: "GET",
    success: function (response) {
      $("#chart2-loader").hide();
      $("#chart2").html(response);
    },
    error: function () {
      $("#chart2-loader").hide();
      $("#chart2").html("Error occurred. Please try again.");
    },
  });
}
