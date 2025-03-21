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
      "assets/php/search-employee-id-v1.php",
      { employee_id: employee_id },
      function (data) {
        tableBody.empty();
        if (data.length > 0) {
          for (let i = 0; i < data.length; i++) {
            let row = $("<tr height='30'></tr>");

            let logDate = new Date(data[i].log_date);
            let formattedDate = logDate.toLocaleDateString("en-US", {
              year: "numeric",
              month: "long",
              day: "2-digit",
            });
            let dayOfWeek = logDate.toLocaleDateString("en-US", {
              weekday: "long",
            });
            let isWeekend = dayOfWeek === "Saturday" || dayOfWeek === "Sunday";

            let holiday = getHoliday(logDate);
            let isHolidayToday = holiday ? true : false;
            let holidayName = holiday ? holiday.name : "";

            let daylog = `${formattedDate}`;

            let workdetail;
            if (!isWeekend) {
              workdetail =
                "";
            } else {
              workdetail = `<span style='color: rgb(248, 48, 35); font-weight: bold;'>${dayOfWeek.toUpperCase()}</span>`;
            }

            if (isHolidayToday) {
              workdetail = `<span style='color: rgb(248, 48, 35); font-weight: bold;'>HOLIDAY [ ${holidayName.toUpperCase()} ]</span>`;
            }

            let dateCell = $("<td contenteditable='true'></td>").html(
              daylog + "<br>8:00 AM - 5:00 PM"
            );
            let workCell = $(
              "<td class='text-center' contenteditable='true'></td>"
            ).html(workdetail);
            let encodedValue = parseInt(data[i].encoded) || 0;

            if (encodedValue == 5) {
              encodedValue = 10;
            }

            if (encodedValue == 0) {
              encodedValue = 10;
              if (isWeekend) {
                encodedValue = 0;
              }
            }

            if (isHolidayToday) {
              encodedValue = 0;
            }

            if (encodedValue == 9) {
              encodedValue = 10;
            }

            if (encodedValue == 8) {
              encodedValue = 10;
            }

            let qtyCell = $(
              "<td class='text-center fs-6' contenteditable='true'></td>"
            ).text(encodedValue);


            row.append(dateCell, workCell, qtyCell);
            tableBody.append(row);

            totalEncoded += encodedValue;

            // Event listener to update totalEncoded when the user edits a cell
            qtyCell.on("input", function () {
              let newValue = parseInt($(this).text()) || 0;
              if (newValue !== encodedValue) {
                totalEncoded = totalEncoded - encodedValue + newValue;
                encodedValue = newValue;
                updateTotal();
              }
            });

            // Event listener to handle work detail edits
            workCell.on("blur", function () {
              // Logic to save the updated work details can be added here
            });
          }
        } else {
          let noDataRow = $("<tr></tr>");
          let noDataCell = $("<td colspan='3' class='text-center'></td>").text(
            "No data available."
          );
          noDataRow.append(noDataCell);
          tableBody.append(noDataRow);
        }
      }
    );

    var fullnameRequest = $.post(
      "assets/php/get-fullname.php",
      { employee_id: employee_id },
      function (data) {
        spanElement.textContent = data[0].h_fullname;
      }
    );

    $.when(tableRequest, fullnameRequest).done(function () {
      tableFooter.empty();
      let footerRow = $("<tr></tr>");
      let footerCell = $(
        "<td colspan='2' class='text-right' style='background: rgb(251,220,220); font-weight: bold;'></td>"
      ).text("Total Encoded:");
      let totalCell = $(
        "<td class='text-center' style='background: rgb(251,220,220); font-weight: bold;'></td>"
      ).text(totalEncoded);
      footerRow.append(footerCell);
      footerRow.append(totalCell);
      tableFooter.append(footerRow);

      myModal.hide();
    });

    // Function to update the total encoded value
    function updateTotal() {
      tableFooter.find("td:last-child").text(totalEncoded);
    }
  });
});
