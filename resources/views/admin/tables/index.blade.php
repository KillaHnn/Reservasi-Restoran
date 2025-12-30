@extends('layouts.app')

@section('title', 'Manage Tables')
@section('page_title', 'Restaurant Tables')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold" style="color: var(--primary)">Table List</h5>
                    <button class="btn btn-resto px-4" data-bs-toggle="modal" data-bs-target="#modalAddTable">
                        <i class="fas fa-plus me-2"></i> Add New Table
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="tableData" class="table table-hover align-middle" style="width:100%">
                        <thead>
                            <tr class="text-muted small">
                                <th>TABLE NO.</th>
                                <th>CAPACITY</th>
                                <th>AREA</th>
                                <th>STATUS</th>
                                <th class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="fw-bold">T-01</span></td>
                                <td>2 Persons</td>
                                <td><span class="badge bg-light text-dark px-3 py-2">Indoor</span></td>
                                <td><span class="badge bg-success-subtle text-success px-3 py-2">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal"
                                        data-bs-target="#modalEditTable"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete()"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">V-01</span></td>
                                <td>6 Persons</td>
                                <td><span class="badge bg-warning-subtle text-warning px-3 py-2">VIP</span></td>
                                <td><span class="badge bg-success-subtle text-success px-3 py-2">Active</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">O-05</span></td>
                                <td>4 Persons</td>
                                <td><span class="badge bg-info-subtle text-info px-3 py-2">Outdoor</span></td>
                                <td><span class="badge bg-danger-subtle text-danger px-3 py-2">Inactive</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form id="globalDeleteForm" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddTable" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold" style="color: var(--primary)">Add New Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="small fw-bold mb-2">TABLE NUMBER</label>
                            <input type="text" name="table_number" class="form-control bg-light border-0 p-3"
                                placeholder="e.g. T-01" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold mb-2">CAPACITY (Persons)</label>
                            <input type="number" name="capacity" class="form-control bg-light border-0 p-3"
                                placeholder="e.g. 4" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold mb-2">AREA</label>
                            <select name="area" class="form-select bg-light border-0 p-3" required>
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                                <option value="vip">VIP Area</option>
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

    <div class="modal fade" id="modalEditTable" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold" style="color: var(--secondary)">Edit Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="small fw-bold mb-2">TABLE NUMBER</label>
                            <input type="text" name="table_number" class="form-control bg-light border-0 p-3"
                                value="T-01" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold mb-2">STATUS</label>
                            <select name="status" class="form-select bg-light border-0 p-3">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="submit" class="btn btn-resto w-100 py-3">Update Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search tables...",
                    "lengthMenu": "_MENU_",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "dom": '<"d-flex justify-content-between align-items-center mb-3"f l>rt<"d-flex justify-content-between align-items-center mt-3"i p>'
            });

            $('.dataTables_filter input').addClass('form-control');
        });

        function confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This table will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A31B31',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Deleted!', 'Table has been deleted.', 'success');
                }
            })
        }
    </script>
@endpush
