<!-- requires the Function.php -->
<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="viewEmployeeLabel">MRT3 Employees</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="search-form">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="view_search">Name</label>
                            <input type="text" id="view_search" class="form-control" list="employeeList" placeholder="Employee name ...">
                            <datalist id="employeeList">
                                <?php
                                foreach (getAllEmployee() as $r) {
                                    $LastName = $r['LastName'];
                                    $FirstName = $r['FirstName'];
                                    $employeeName = "$LastName, $FirstName";
                                    echo "<option value='$employeeName'>$employeeName</option>";
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col-md-4">
                            <label for="view_designation">Designation</label>
                            <select id="view_designation" class="form-select">
                                <?php
                                foreach (getAllDesignation() as $r) {
                                    $ID = $r['id'];
                                    $Designation = $r['Designation'];
                                    echo "<option value='$ID'>$Designation</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="view_division">Division</label>
                            <select id="view_division" class="form-select">
                                <?php
                                foreach (getAllDivision() as $r) {
                                    $ID = $r['id'];
                                    $Division = $r['Division'];
                                    echo "<option value='$ID'>$Division</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </form>
                <div id="viewAttendeeTable"></div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="hiddenTrainingID" value="">
            </div>
        </div>
    </div>
</div>