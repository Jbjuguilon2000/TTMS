<!-- Modal -->
<div class="modal fade" id="viewEmployeeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewEmployeeModalLabel">Employee Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary" role="status" id="view-loader"></div>
                </div>
                <div id="view"></div>
                <input type="hidden" id="hiddenID" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="printForm()"><i class="bi bi-printer me-2"></i>Certificate</button>
            </div>
        </div>
    </div>
</div>