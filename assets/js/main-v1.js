$(document).ready(function () {
  var tableBody = $("#dataTable tbody");
  var tableFooter = $("#dataTable tfoot");
  var myModal = new bootstrap.Modal(document.getElementById("get"));
  myModal.show();

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
            let daylog = `${formattedDate}`;
  
            let workdetail;
            if (!isWeekend) {
              workdetail = "";
            } else {
              workdetail = `<span style='color: rgb(248, 48, 35); font-weight: bold;'>${dayOfWeek.toUpperCase()}</span>`;
            }
  
            let dateCell = $("<td contenteditable='true'></td>").text(daylog);
            let workCell = $("<td class='text-center' contenteditable='true'></td>").html(workdetail);
            let encodedValue = parseInt(data[i].encoded) || 0;
            let qtyCell = $("<td class='text-center text-white' contenteditable='true'></td>").text(encodedValue);
  
            if (encodedValue === 0) {
              if (!isWeekend) {
                qtyCell.addClass("bg-success");
              } else {
                qtyCell.addClass("bg-success");
              }
            } else if (encodedValue < 10) {
              qtyCell.addClass("bg-success");
            } else {
              qtyCell.addClass("bg-success");
            }
  
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
          let noDataCell = $("<td colspan='3' class='text-center'></td>").text("No data available.");
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
      let footerCell = $("<td colspan='2' class='text-right' style='background: rgb(251,220,220); font-weight: bold;'></td>").text("Total Encoded:");
      let totalCell = $("<td class='text-center' style='background: rgb(251,220,220); font-weight: bold;'></td>").text(totalEncoded);
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
