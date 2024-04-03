<!-- requires the Function.php -->

<div class="modal fade" id="createTrainingModal" tabindex="-1" aria-labelledby="createTrainingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5 text-primary" id="createTrainingLabel">Create Training</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group mb-2">
                                <label for="c_course">Course:</label>
                                <select id="c_course" class="form-select" required>
                                    <option value="" selected>-</option>
                                    <?php
                                    foreach (getAllCourse() as $r) {
                                        $ID = $r['ID'];
                                        $Course = $r['Course'];
                                        echo "<option value='$ID'>$Course</option>";
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Select a training course.</div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label for="c_batch">Batch No:</label>
                                <input type="number" class="form-control" placeholder="-" id="c_batch" required>
                                <div class="invalid-feedback">Add batch number.</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <div class="dropdown">
                                    <label for="select_subjects">Subject/s:</label>
                                    <input type="hidden" id="c_subjects">
                                    <input type="text" class="form-control form-select" placeholder="-" id="select_subjects" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" required>
                                    <ul style=" max-height: 200px; overflow-y:auto;" class="dropdown-menu dropdown-menu-end">
                                        <?php
                                        foreach (getAllSubject() as $r) {
                                            echo '<li class="dropdown-item">
                                            <input class="form-check-input cb_sbjct" id="sbjtID' . $r['ID'] . '" type="checkbox" value="' . $r['ID'] . '" name="' . $r['Subject'] . '">
                                            <label for="sbjtID' . $r['ID'] . '" class="form-check-label">' . $r['Subject'] . '</label>
                                            </li>';
                                        }
                                        ?>
                                    </ul>
                                    <div class="invalid-feedback">Select trainer/s for the subjects.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="c_startdate">Start Date:</label>
                                <input type="date" class="form-control" id="c_startdate" required>
                                <div class="invalid-feedback">Input training start date.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="c_enddate">End Date:</label>
                                <input type="date" class="form-control" id="c_enddate" required>
                                <div class="invalid-feedback">Input training end date.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="c_status">Training Status:</label>
                                <select id="c_status" class="form-select" required>
                                    <?php
                                    foreach (getAllTrainingStatus() as $r) {
                                        $ID = $r['ID'];
                                        $Status = $r['Status'];
                                        $selected = ($ID == 3) ? 'selected' : '';
                                        echo "<option $selected value='$ID'>$Status</option>";
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Input training end date.</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <div class="dropdown">
                                    <label for="select_trainers">Trainer/s:</label>
                                    <input type="hidden" id="c_trainers">
                                    <input type="text" class="form-control form-select" placeholder="-" id="select_trainers" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" required>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php
                                        foreach (getAllTrainers() as $r) {
                                            echo '<li class="dropdown-item">
                                                    <input class="form-check-input cb_trnr" id="trnID' . $r['ID'] . '" type="checkbox" value="' . $r['ID'] . '" name="' . $r['Trainer'] . '">
                                                    <label for="trnID' . $r['ID'] . '" class="form-check-label">' . $r['Trainer'] . '</label>
                                                </li>';
                                        }
                                        ?>
                                    </ul>
                                    <div class="invalid-feedback">Select trainer/s for the training.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <div class="dropdown">
                                    <label for="select_divisions">Division/s:</label>
                                    <input type="hidden" id="c_divisions">
                                    <input type="text" class="form-control form-select" placeholder="-" id="select_divisions" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" required>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php
                                        foreach (getAllDivision() as $r) {
                                            echo '<li class="dropdown-item">
                                                    <input class="form-check-input cb_dvsn" id="dvnID' . $r['ID'] . '" type="checkbox" value="' . $r['ID'] . '" name="' . $r['Division'] . '">
                                                    <label for="dvnID' . $r['ID'] . '" class="form-check-label">' . $r['Division'] . '</label>
                                                </li>';
                                        }
                                        ?>
                                    </ul>
                                    <div class="invalid-feedback">Select trainer/s for the division.</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="c_remarks">Remarks:</label>
                                <textarea class="form-control" id="c_remarks" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="createTrainingFormValidation()" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var TrainerIDArray = [];
        var TrainerNameArray = [];
        var DivisionIDArray = [];
        var DivisionNameArray = [];
        var SubjectIDArray = [];
        var SubjectNameArray = [];

        $('#createTrainingModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            TrainerIDArray = [];
            TrainerNameArray = [];
            DivisionIDArray = [];
            DivisionNameArray = [];
            SubjectIDArray = [];
            SubjectNameArray = [];
            $(this).find('form').removeClass('was-validated');
        });

        for (var checkbox of document.querySelectorAll(".cb_trnr")) {
            checkbox.addEventListener("click", function() {
                if (this.checked) {
                    TrainerIDArray.push(this.value);
                    TrainerNameArray.push(this.getAttribute("name"));
                } else {
                    TrainerIDArray = TrainerIDArray.filter((e) => e !== this.value);
                    TrainerNameArray = TrainerNameArray.filter(
                        (e) => e !== this.getAttribute("name")
                    );
                }

                $("#c_trainers").val("" + TrainerIDArray.join(",") + "");
                $("#select_trainers").val(TrainerNameArray.join(", "));
            });
        }

        for (var checkbox of document.querySelectorAll(".cb_dvsn")) {
            checkbox.addEventListener("click", function() {
                if (this.checked) {
                    DivisionIDArray.push(this.value);
                    DivisionNameArray.push(this.getAttribute("name"));
                } else {
                    DivisionIDArray = DivisionIDArray.filter((e) => e !== this.value);
                    DivisionNameArray = DivisionNameArray.filter(
                        (e) => e !== this.getAttribute("name")
                    );
                }

                $("#c_divisions").val("" + DivisionIDArray.join(",") + "");
                $("#select_divisions").val(DivisionNameArray.join(", "));
            });
        }

        for (var checkbox of document.querySelectorAll(".cb_sbjct")) {
            checkbox.addEventListener("click", function() {
                if (this.checked) {
                    SubjectIDArray.push(this.value);
                    SubjectNameArray.push(this.getAttribute("name"));
                } else {
                    SubjectIDArray = SubjectIDArray.filter((e) => e !== this.value);
                    SubjectNameArray = SubjectNameArray.filter(
                        (e) => e !== this.getAttribute("name")
                    );
                }

                $("#c_subjects").val("" + SubjectIDArray.join(",") + "");
                $("#select_subjects").val(SubjectNameArray.join(", "));
            });
        }

    });

    function createTrainingFormValidation() {
        var form = $('#createTrainingModal form');
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.addClass('was-validated');

        if (form[0].checkValidity() === true) {
            // console.log("Valid");
            create();
        }
    }

    
</script>