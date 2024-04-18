<div class="modal fade" id="deleteTrainingModal" tabindex="-1" aria-labelledby="deleteTrainingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" id="hiddenTrainingID" value="">
                <h3 class="text-center text-danger"><i class="bi bi-exclamation-triangle"></i></h3>
                <h4 class="text-center">Are you sure?</h4>
                <p class="text-center text-muted">
                    All data associated to this training will be lost.
                </p>
                <div>
                    <button type="button" class="btn btn-danger w-100 mb-2" onclick="deleteData()">Delete</button>
                    <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>