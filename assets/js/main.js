function showSweetAlert(title, text, icon, timer) {
  let timerInterval;
  Swal.fire({
    title: title,
    text: text,
    icon: icon,
    timer: timer,
    timerProgressBar: true,
    willClose: () => {
      clearInterval(timerInterval);
    },
  });
}
function submitLoginForm(formId) {
    console.log(formId);
    $(formId).submit(function (e) {
      e.preventDefault();
      var form = $(this);
      var url = "assets/php/login.php";
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function (data) {
          // console.log(data); 
          var result = JSON.parse(data);
          showSweetAlert(
            result.status.toUpperCase(),
            result.message,
            result.status,
            5000
          );
          if (result.status == "success") {
            setTimeout(function () {
              window.location.href = "dashboard.php";
            }, 500);
      }
        },
        error: function (data) {
          var result = JSON.parse(data);
          showSweetAlert(
            result.status.toUpperCase(),
            result.message,
            result.status,
            5000
          );
        },
      });
    });
  }

function submitForm(formId, tableId, api) {
    console.log(formId + " READY");
    $(formId).submit(function (e) {
      e.preventDefault();
      var form = $(this);
      var url = form.attr("action");
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function (data) {
          console.log(data);
          var result = JSON.parse(data);
          showSweetAlert(
            result.status.toUpperCase(),
            result.message,
            result.status,
            2000
          );
          if (api !== "" && tableId !== "") {
            loadDatatable(tableId, api);
          }
        },
        error: function (data) {
          var result = JSON.parse(data);
          showSweetAlert(
            result.status.toUpperCase(),
            result.message,
            result.status,
            2000
          );
        },
      });
    });
  }

$(document).ready(function () {
  var tableBody = $("#dataTable tbody");
  var tableFooter = $("#dataTable tfoot");
  var myModal = new bootstrap.Modal(document.getElementById("get"));
  myModal.show();

  const philippineHolidays = [
    { date: "2025-01-01", name: "New Year's Day" },
    { date: "2025-01-19", name: "Pasalamat Festival" },
    { date: "2025-01-20", name: "Pasalamat Festival" },
    { date: "2025-01-23", name: "First Philippine Republic Day" },
    { date: "2025-01-29", name: "Lunar New Year's Day" },
    { date: "2025-02-25", name: "People Power Anniversary" },
    { date: "2025-03-01", name: "Ramadan Start (Tentative Date)" },
    { date: "2025-03-20", name: "March Equinox" },
    { date: "2025-03-31", name: "Eidul-Fitar (Tentative Date)" },
    { date: "2025-04-09", name: "The Day of Valor" },
    { date: "2025-04-17", name: "Maundy Thursday" },
    { date: "2025-04-18", name: "Good Friday" },
    { date: "2025-04-19", name: "Black Saturday" },
    { date: "2025-04-20", name: "Easter Sunday" },
    { date: "2025-05-01", name: "Labor Day" },
    { date: "2025-06-12", name: "Independence Day" },
    { date: "2025-08-21", name: "Ninoy Aquino Day" },
    { date: "2025-08-25", name: "National Heroes Day" },
    { date: "2025-11-01", name: "All Saints' Day" },
    { date: "2025-11-30", name: "Bonifacio Day" },
    { date: "2025-12-08", name: "Feast of the Immaculate Conception" },
    { date: "2025-12-24", name: "Christmas Eve" },
    { date: "2025-12-25", name: "Christmas Day" },
    { date: "2025-12-30", name: "Rizal Day" },
    { date: "2025-12-31", name: "New Year's Eve" },
  ];

  function getHoliday(date) {
    let formattedDate = date.toLocaleDateString("en-CA");
    return philippineHolidays.find((holiday) => holiday.date === formattedDate);
  }

  $("#get").submit(function (event) {
    event.preventDefault();
    const employee_id = $(this).find("input[name='emp_id']").val();
    var spanElement = document.getElementById("fullname");
    var totalEncoded = 0;

    var tableRequest = $.post(
        "assets/php/search-employee-id.php",
        { employee_id: employee_id },
        function (data) {
            tableBody.empty();
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    console.log(data[i].log_date);
                }
            }
        }
    );

    
});

});

function loadDatatable(tableId, api = "") {
    
  if ($.fn.DataTable.isDataTable(tableId)) {
    $(tableId).DataTable().destroy();
  }

  $(tableId).DataTable({
    ajax: {
      url: api,
      type: "POST",
    },
    search: {
      return: true,
    },
    layout: {
      topStart: {
        buttons: [
          {
            extend: "print",
            text: "Print All",
            title: "HR",
            customize: function (win) {
              // Add logo and institution information
              var logoAndInfo =
                '<div class="row">' +
                '<div class="col-md-8 col-xl-7 text-center text-primary mx-auto">' +
                '<h4 class="mt-1"><strong>HR</strong></h4>' +
                "</div>" +
                "</div>";
              $(win.document.body).prepend(logoAndInfo);
              var table = $(win.document.body).find("table");
              table.prepend(
                '<thead><tr><th colspan="15" style="text-align: center; font-size: 10px;"> HR </th></tr><tr><th colspan="15" style="text-align: right;" id="dateTimeHeader"> Date: ' +
                  new Date().toLocaleString() +
                  "</th></tr></thead>"
              );
              // Style adjustments
              $(win.document.body)
                .find("table")
                .addClass("display")
                .css("font-size", "9px");
              $(win.document.body)
                .find("tr:nth-child(odd) td")
                .each(function (index) {
                  $(this).css("background-color", "#D0D0D0");
                });
              $(win.document.body).find("h1").css({
                "text-align": "center",
                "margin-top": "10px",
                display: "none",
              });
            },
            exportOptions: {
              modifier: {
                selected: null,
              },
              columns: ":visible",
            },
            footer: false,
          },
        ],
      },
    },
    responsive: {
      details: {
        display: DataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return "Details for " + data[1];
          },
        }),
        renderer: DataTable.Responsive.renderer.tableAll({
          tableClass: "table table-striped w-100 fs-4",
        }),
      },
    },
    processing: true,
    serverSide: true,
  });
}

