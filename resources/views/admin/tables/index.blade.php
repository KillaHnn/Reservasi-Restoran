@extends('layouts.app')

@section('title', 'Manage Tables')
@section('page_title', 'Restaurant Tables')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold" style="color: var(--primary)">Table List</h5>
                    <button id="btnAdd" class="btn btn-resto px-4">
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
                            @foreach($tables as $table)
                                <tr data-id="{{ $table->id }}">
                                    <td><span class="fw-bold">{{ $table->table_number }}</span></td>
                                    <td>{{ $table->capacity }} Persons</td>
                                    <td>
                                        @if($table->area == 'vip')
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2">VIP</span>
                                        @elseif($table->area == 'outdoor')
                                            <span class="badge bg-info-subtle text-info px-3 py-2">Outdoor</span>
                                        @else
                                            <span class="badge bg-light text-dark px-3 py-2">Indoor</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($table->status == 'active')
                                            <span class="badge bg-success-subtle text-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-1 btn-edit" data-id="{{ $table->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $table->id }}" data-url="{{ route('admin.tables.destroy', $table) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                        <div id="formErrors" class="alert alert-danger d-none"></div>
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

    <!-- Single Modal for Create/Edit -->
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
                            <input type="text" name="table_number" class="form-control bg-light border-0 p-3" placeholder="e.g. T-01" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold mb-2">CAPACITY (Persons)</label>
                            <input type="number" name="capacity" class="form-control bg-light border-0 p-3" placeholder="e.g. 4" min="1" required>
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

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            const modalEl = document.getElementById('modalTable');
            const modal = new bootstrap.Modal(modalEl);
            const form = document.getElementById('tableForm');
            const formErrors = document.getElementById('formErrors');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Add new
            document.getElementById('btnAdd').addEventListener('click', function() {
                form.reset();
                form.action = "{{ route('admin.tables.store') }}";
                form.querySelector('input[name=_method]').value = 'POST';
                document.getElementById('modalTitle').textContent = 'Add New Table';
                formErrors.classList.add('d-none');
                modal.show();
            });

            // Edit
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                fetch(`/admin/tables/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                    .then(res => res.json())
                    .then(data => {
                        form.action = `/admin/tables/${id}`;
                        form.querySelector('input[name=_method]').value = 'PUT';
                        form.querySelector('input[name=table_number]').value = data.table_number;
                        form.querySelector('input[name=capacity]').value = data.capacity;
                        form.querySelector('select[name=area]').value = data.area;
                        form.querySelector('select[name=status]').value = data.status;
                        document.getElementById('modalTitle').textContent = 'Edit Table';
                        formErrors.classList.add('d-none');
                        modal.show();
                    })
                    .catch(() => Swal.fire('Error', 'Unable to fetch table data', 'error'));
            });

            // Submit create/update
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const url = form.action;
                const body = new URLSearchParams(new FormData(form));

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body
                }).then(async res => {
                    if (!res.ok) {
                        const data = await res.json().catch(() => ({}));
                        if (res.status === 422 && data.errors) {
                            const errors = Object.values(data.errors).flat().join('<br>');
                            formErrors.innerHTML = errors;
                            formErrors.classList.remove('d-none');
                            return Promise.reject('validation');
                        }
                        return Promise.reject('server');
                    }
                    return res.json();
                }).then(() => {
                    modal.hide();
                    Swal.fire('Success', 'Saved successfully', 'success').then(() => location.reload());
                }).catch(err => {
                    if (err !== 'validation') Swal.fire('Error', 'An error occurred', 'error');
                });
            });

            // Delete
            $(document).on('click', '.btn-delete', function() {
                const url = $(this).data('url');
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
                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new URLSearchParams({'_method':'DELETE'})
                        }).then(res => {
                            if (!res.ok) throw new Error('delete-failed');
                            return res.json();
                        }).then(() => {
                            Swal.fire('Deleted!', 'Table has been deleted.', 'success').then(() => location.reload());
                        }).catch(() => {
                            Swal.fire('Error', 'Could not delete table', 'error');
                        });
                    }
                })
            });
        });
    </script>
@endpush
