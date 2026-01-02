<div class="modal fade" id="modalTable" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <form id="tableForm" action="{{ route('admin.tables.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold" id="modalTitle" style="color: var(--primary)">Add New Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div id="formErrors" class="alert alert-danger d-none"></div>

                    <div class="mb-3">
                        <label class="small fw-bold mb-2">TABLE NUMBER</label>
                        <input type="text" name="table_number" class="form-control bg-light border-0 p-3"
                            placeholder="e.g. T-01" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">CAPACITY (Persons)</label>
                        <input type="number" name="capacity" class="form-control bg-light border-0 p-3"
                            placeholder="e.g. 4" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">AREA</label>
                        <select name="area" class="form-select bg-light border-0 p-3" required>
                            <option value="indoor">Indoor</option>
                            <option value="outdoor">Outdoor</option>
                            <option value="vip">VIP Area</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">STATUS</label>
                        <select name="status" class="form-select bg-light border-0 p-3" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-resto px-4">Save Table</button>
                </div>
            </form>
        </div>
    </div>
</div>
