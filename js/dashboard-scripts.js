$(function () {
  chartsData();
});

function chartsData() {
  chart1();
  chart2();
  cards();
}

function chart1() {
  var StartDate = $("#start-date").val();
  var EndDate = $("#end-date").val();

  $.ajax({
    url: "views/Dashboards/chart-1.php",
    type: "POST",
    data: {
      StartDate: StartDate,
      EndDate: EndDate,
    },
    success: function (response) {
      $("#chart1-loader").hide();
      $("#chart1").html(response);
    },
    error: function () {
      $("#chart1-loader").show();
    },
  });
}

function chart2() {
  var StartDate = $("#start-date").val();
  var EndDate = $("#end-date").val();

  $("#chart2-loader").show();

  $.ajax({
    url: "views/Dashboards/chart-2.php",
    type: "POST",
    data: {
      StartDate: StartDate,
      EndDate: EndDate,
    },
    success: function (response) {
      $("#chart2-loader").hide();
      $("#chart2").html(response);
    },
    error: function () {
      $("#chart2-loader").show();
    },
  });
}

function cards() {
  var StartDate = $("#start-date").val();
  var EndDate = $("#end-date").val();

  $("#cards-loader").show();

  $.ajax({
    url: "views/Dashboards/cards.php",
    type: "POST",
    data: {
      StartDate: StartDate,
      EndDate: EndDate,
    },
    success: function (response) {
      $("#cards-loader").hide();
      $("#cards").html(response);
    },
    error: function (response) {
      $("#cards-loader").show();
    },
  });
}
