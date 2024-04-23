<!-- requires the Function.php -->
<div class="modal fade" id="addTraineeModal" tabindex="-1" aria-labelledby="addTraineeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="addTraineeLabel">Add Attendee</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="at_name"></label>
                        <input type="text" id="at_name" class="form-control" list="employeeList">
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
                        <label for="at_name"></label>
                        <select name="" id=""></select>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                <div id="addAttendeeTable"></div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hiddenTrainingID" value="">
            </div>
        </div>
    </div>
</div>