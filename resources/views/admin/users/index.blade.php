@extends('layouts.app')

@section('title', 'User Management')
@section('page_title', 'User Management')

@section('content')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    html: '{!! implode('<br>', $errors->all()) !!}',
                    confirmButtonColor: '#A31B31',
                });
            });
        </script>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card card-custom p-4 border-0 shadow-sm" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0" style="color: #A31B31">User Management</h5>
                        <p class="text-muted small mb-0">Kelola data admin, kasir, dan pelanggan Anda.</p>
                    </div>
                    <button class="btn btn-resto px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddUser">
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
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 text-uppercase"
                                                style="font-size: 10px;">Admin</span>
                                        @elseif($user->role == 'cashier')
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 text-uppercase"
                                                style="font-size: 10px;">Cashier</span>
                                        @else
                                            <span class="badge bg-info-subtle text-info px-3 py-2 text-uppercase"
                                                style="font-size: 10px;">Customer</span>
                                        @endif
                                    </td>
                                    <td class="small text-muted">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-warning rounded-3 me-2"
                                                onclick="editUser('{{ $user->id }}', '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->phone_number }}', '{{ $user->role }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            @if (Auth::id() !== $user->id)
                                                <button class="btn btn-sm btn-outline-danger rounded-3"
                                                    onclick="confirmDeleteUser('{{ $user->id }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form id="globalDeleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    @include('admin.users.modal.add')
    @include('admin.users.modal.edit')

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableUsers').DataTable({
                "pageLength": 10,
                "responsive": true,
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

        function editUser(id, name, email, phone, role) {
            const form = $('#formEditUser');
            form.attr('action', '/admin/users/' + id);

            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_phone').val(phone);
            $('#edit_role').val(role);

            $('#modalEditUser').modal('show');
        }

        function confirmDeleteUser(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data user akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A31B31',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('#globalDeleteForm');
                    form.attr('action', '/admin/users/destroy/' + id);
                    form.submit();
                }
            });
        }
    </script>
@endpush
