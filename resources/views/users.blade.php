@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229));
    min-height: 100vh;
  }
</style>
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-primary mb-0" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahUser">+&nbsp; New User</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Photo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 d-none">Role</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terakhir Online</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="{{ asset('storage/' . $user->photo) }}" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center d-none">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->last_seen }}</span>
                                    </td>
                                    <td class="text-center" id="status-{{ $user->id }}">
                                        @if($user->is_online)
                                            <span class="text-success">● Online</span>
                                        @else
                                            <span class="text-muted">● Offline</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" onclick="openEditModal({{ $user->id }})">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete({{ $user->id }})">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="userForm" action="{{ url('/user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahUserLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div id="formMethod"></div>
                    <div class="form-group col-md-6">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Alamat</label>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Photo</label>
                        <input type="file" accept="image/*" name="photo" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Tentang Saya</label>
                        <textarea name="about_me" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function openEditModal(id) {
        $.ajax({
            url: `/api/user/${id}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $("input[name='password']").prop('required', false);
                    $("input[name='name']").val(response.data.name);
                    $("input[name='email']").val(response.data.email);
                    $("input[name='phone']").val(response.data.phone);
                    $("input[name='location']").val(response.data.location);
                    $("textarea[name='about_me']").val(response.data.about_me);
                    $('#modalTambahUserLabel').text('Edit User');
                    $('#userForm').attr('action', `/user/${id}`);
                    $('#formMethod').html('@method("PUT")');
                    const modal = new bootstrap.Modal(document.getElementById('modalTambahUser'));
                    modal.show();
                }
            },
            error: function () {
                alert("Gagal ambil data user.");
            },
        });
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin menghapus user?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/user/delete/${id}`;
            }
        });
    }

    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2500,
        showConfirmButton: false
    });
    @endif

    function updateUserStatus() {
        fetch('/api/user-status')
            .then(response => response.json())
            .then(data => {
                data.forEach(user => {
                    const el = document.getElementById('status-' + user.id);
                    if (el) {
                        el.innerHTML = user.is_online
                            ? '<span class="text-success">● Online</span>'
                            : '<span class="text-muted">● Offline</span>';
                    }
                });
            });
    }

    setInterval(updateUserStatus, 5000);
    updateUserStatus();
</script>
@endsection
