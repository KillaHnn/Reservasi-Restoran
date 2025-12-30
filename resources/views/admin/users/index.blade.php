@extends('layouts.app')

@section('title', 'User Management')
@section('page_title', 'User Management')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card card-custom p-4 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold" style="color: var(--primary)">All Registered Users</h5>
                    <button class="btn btn-resto px-4">
                        <i class="fas fa-user-plus me-2"></i> Add New User
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="tableUsers" class="table table-hover align-middle" style="width:100%">
                        <thead>
                            <tr class="text-muted small">
                                <th>USER</th>
                                <th>CONTACT INFO</th>
                                <th>ROLE</th>
                                <th>JOINED DATE</th>
                                <th class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=A31B31&color=FFC069"
                                                class="rounded-circle" width="40">
                                            <div>
                                                <div class="fw-bold mb-0 text-dark">{{ $user->name }}</div>
                                                <div class="small text-muted">ID:
                                                    #USR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small"><i
                                                class="fas fa-envelope me-2 text-muted"></i>{{ $user->email }}</div>
                                        <div class="small"><i
                                                class="fas fa-phone me-2 text-muted"></i>{{ $user->phone_number ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->role == 'admin')
                                            <span
                                                class="badge bg-danger-subtle text-danger px-3 py-2 text-uppercase">Admin</span>
                                        @elseif($user->role == 'cashier')
                                            <span
                                                class="badge bg-warning-subtle text-warning px-3 py-2 text-uppercase">Cashier</span>
                                        @else
                                            <span
                                                class="badge bg-info-subtle text-info px-3 py-2 text-uppercase">Customer</span>
                                        @endif
                                    </td>
                                    <td class="small text-muted">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-1" title="Edit User"
                                            onclick="editUser('{{ $user->id }}', '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->phone_number }}', '{{ $user->role }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        @if (Auth::id() !== $user->id)
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="confirmDeleteUser('{{ $user->id }}')" title="Delete User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit User --}}
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

    <form id="formDeleteUser" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableUsers').DataTable({
                "pageLength": 10,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search users...",
                    "lengthMenu": "_MENU_",
                    "paginate": {
                        "previous": "<i class='fas fa-chevron-left'></i>",
                        "next": "<i class='fas fa-chevron-right'></i>"
                    }
                },
                "dom": '<"d-flex justify-content-between align-items-center mb-3"f l>rt<"d-flex justify-content-between align-items-center mt-3"i p>'
            });
            $('.dataTables_filter input').addClass('form-control border-0 shadow-sm px-3').css('background-color',
                '#F8F0E3');
        });

        // Fungsi untuk memicu Modal Edit dan mengisi datanya
        function editUser(id, name, email, phone, role) {
            $('#formEditUser').attr('action', '/admin/users/' + id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_phone').val(phone);
            $('#edit_role').val(role);
            $('#modalEditUser').modal('show');
        }

        // Fungsi Delete dengan SweetAlert2
        function confirmDeleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This user will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A31B31',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('#formDeleteUser');
                    form.attr('action', '/admin/users/' + id);
                    form.submit();
                }
            })
        }
    </script>
@endpush
