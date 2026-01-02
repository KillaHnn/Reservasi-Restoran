<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold" style="color: var(--primary)">Edit User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditUser" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">FULL NAME</label>
                        <input type="text" name="name" id="edit_name" class="form-control bg-light border-0 p-3"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">EMAIL ADDRESS</label>
                        <input type="email" name="email" id="edit_email" class="form-control bg-light border-0 p-3"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">PHONE NUMBER</label>
                        <input type="text" name="phone_number" id="edit_phone"
                            class="form-control bg-light border-0 p-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">ROLE</label>
                        <select name="role" id="edit_role" class="form-select bg-light border-0 p-3" required>
                            <option value="customer">Customer</option>
                            <option value="cashier">Cashier</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-resto px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
