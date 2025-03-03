<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accomplishment</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Abril%20Fatface.css">
    <link rel="stylesheet" href="assets/css/Aleo.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 text-end"><img src="assets/img/province.png" width="85vm"></div>
            <div class="col-sm-8 col-md-8">
                <p class="text-center mt-0 mb-0" style="font-size: 14px;">Republic of the Philippines</p>
                <p class="text-center mt-0 mb-0" style="font-family: Aleo, serif;font-size: 16px;"><span style="color: rgb(248, 48, 35);">Province of Zamboanga del Sur</span></p>
                <p class="text-center mt-0 mb-0" style="font-family: Aleo, serif;font-size: 17px;"><strong><span style="color: rgb(35, 95, 248);">ZAMBOANGA DEL SUR MEDICAL CENTER</span></strong></p>
                <p class="text-center mt-0 mb-0" style="font-family: Aleo, serif;font-size: 12px;"><span style="color: rgb(0, 0, 0);">Dao, Pagadian City</span><br><span style="color: rgb(0, 0, 0);">Tel&nbsp;No.(62) 214-1467</span><br><span style="color: rgb(0, 0, 0);">Fax (62) 214-4698</span></p>
            </div>
            <div class="col-sm-2 col-md-2 text-start"><img src="assets/img/zdsmc.png" width="85vm"></div>
        </div>
        <hr class="mb-0" style="padding: 1px;background: var(--bs-emphasis-color);">
    </div>
    <div class="container-fluid">
        <div class="row mt-0 mb-0">
            <div class="col">
                <p class="text-center mt-2 mb-0" style="font-family: Aleo, serif;font-size: 15px;"><strong>ACCOMPLISHMENT REPORT</strong></p>
                <p class="text-center mt-0 mb-0" style="font-family: Aleo, serif;font-size: 10px;"><span style="color: rgb(0, 0, 0);">For the Month of February</span></p>
                <p class="text-start mt-0 mb-0" style="font-family: Aleo, serif;font-size: 10px;">Area Assigned: Philhealth Billing and Claims (Data Center)</p>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-5">
        <div class="table-responsive" style="font-size: 11px;">
            <table class="table table-sm table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th style="background: rgb(251,220,220);">Date</th>
                        <th class="text-center" style="background: rgb(251,220,220);">WORK ACCOMPLISHMENT</th>
                        <th class="text-center" style="background: rgb(251,220,220);">Quantity</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right" style="background: rgb(251,220,220); font-weight: bold;">Total Encoded:</td>
                        <td class="text-center" style="background: rgb(251,220,220); font-weight: bold;">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-sm-6 col-md-6 text-center">
                <p class="text-center mt-0 mb-0"><strong>Prepared by:</strong></p>
                <p class="mt-0 mb-0"><br><strong><span style="text-decoration: underline;" id="fullname"></span></strong></p>
                <p class="text-center mt-0 mb-5">Employee</p>
            </div>
            <div class="col-sm-6 col-md-6">
                <p class="text-center mt-0 mb-0"><strong>Checked by:</strong></p>
                <p class="text-center mt-0 mb-0"><br><strong><span style="text-decoration: underline;">DR.RICO C. OCAMPO</span></strong></p>
                <p class="text-center mt-0 mb-5">Supervisor</p>
            </div>
            <div class="col-sm-6 col-md-6">
                <p class="text-center mt-5 mb-0"><strong>Date Submitted:</strong></p>
                <p class="text-center mt-0 mb-0"><br><strong><?= date('Y-m-d h:i:s A') ?></strong></p>
            </div>
            <div class="col-sm-6 col-md-6 text-center">
                <p class="mt-5 mb-0"><strong>Approved by:</strong></p>
                <p class="mt-0 mb-0"><br><strong><span style="text-decoration: underline;">HELEN L. MANIAGO</span></strong></p>
                <p class="text-center mt-0">SAO</p>
            </div>
        </div>
        <p class="font-monospace" style="font-size: 8px;">Digital Signature:&nbsp;<?= hash('sha256', date('Y-m-d h:i:s A')) ?></p>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="get">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">My Accomplishment</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>The content of your modal.</p>
                    <form><input class="form-control mb-3" type="text" name="emp_id" placeholder="Employee ID"><button class="btn btn-primary w-100" type="submit">Get Accomplishments</button></form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>