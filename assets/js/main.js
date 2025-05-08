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

