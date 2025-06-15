@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 To-Do List (Drag & Drop)</h2>

    <!-- Form Tambah Task -->
    <form id="addTaskForm" method="POST" action="{{ route('todolist.store') }}" class="mb-4">
        @csrf
        <div class="input-group mb-3 d-flex gap-2">
            <input type="text" name="title" id="addTaskTitle" class="form-control" placeholder="Tambah task baru..." required>
            <button class="btn btn-primary mb-0" type="submit" style="border-radius: 10px;">Tambah</button>
            <button id="btnEditSelected" class="btn btn-warning" disabled style="border-radius: 10px;">✎ Edit Task Terpilih</button>
        <button id="btnDeleteSelected" class="btn btn-danger" disabled style="border-radius: 10px;">🗑️ Hapus Task Terpilih</button>
        </div>
    </form>

    <!-- Board -->
    <div class="row">
        @php
            $statuses = ['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'];
        @endphp

        @foreach ($statuses as $status => $label)
        <div class="col-md-4 position-relative">
            <h5 class="text-center">{{ $label }}</h5>
            <div class="board-column border p-2 rounded min-vh-50" data-status="{{ $status }}" id="{{ $status }}">
                @foreach ($tasks->where('status', $status) as $task)
                    <div class="task card p-2 mb-2 d-flex justify-content-between align-items-center {{ $task->status === 'done' ? 'bg-success text-white' : '' }}" 
                         data-id="{{ $task->id }}" data-title="{{ $task->title }}" data-done="{{ $task->status === 'done' ? 'true' : 'false' }}" tabindex="0" style="cursor:pointer;">
                        <span class="task-title">
                            {!! $task->status === 'done' ? '<span>✔️</span> ' : '' !!}
                            {{ $task->title }}
                        </span>
                    </div>
                @endforeach
            </div>
            @if ($status === 'done')
            <canvas class="confetti-canvas position-absolute top-0 start-0 w-100 h-100" style="pointer-events: none;"></canvas>
            @endif
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editTaskForm" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="editTaskId">
            <div class="mb-3">
                <label for="editTaskTitle" class="form-label">Task Title</label>
                <input type="text" id="editTaskTitle" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<!-- Confetti JS -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  let selectedTask = null;

  // Fungsi aktif/nonaktif tombol Edit & Hapus
  function updateActionButtons() {
    const btnEdit = document.getElementById('btnEditSelected');
    const btnDelete = document.getElementById('btnDeleteSelected');
    if (selectedTask) {
      btnEdit.removeAttribute('disabled');
      btnDelete.removeAttribute('disabled');
    } else {
      btnEdit.setAttribute('disabled', 'true');
      btnDelete.setAttribute('disabled', 'true');
    }
  }

  // Event click untuk task (pilih/batal pilih)
  document.querySelectorAll('.task').forEach(task => {
    task.addEventListener('click', () => {
      // Jika task yang sama diklik dua kali, batalkan seleksi
      if (selectedTask === task) {
        task.classList.remove('selected-task');
        selectedTask = null;
      } else {
        // Jika task lain diklik, hapus seleksi sebelumnya
        if (selectedTask) {
          selectedTask.classList.remove('selected-task');
        }
        selectedTask = task;
        task.classList.add('selected-task');
      }
      updateActionButtons();
    });
  });

  // Tambah style untuk task terpilih
  const style = document.createElement('style');
  style.textContent = `
    .selected-task {
      outline: 3px solid #0d6efd;
      background-color: #e7f1ff !important;
    }
  `;
  document.head.appendChild(style);

  // Tombol Edit
  document.getElementById('btnEditSelected').addEventListener('click', () => {
    if (!selectedTask) return;
    const id = selectedTask.dataset.id;
    const title = selectedTask.dataset.title;
    document.getElementById('editTaskId').value = id;
    document.getElementById('editTaskTitle').value = title;
    const editModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
    editModal.show();
  });

  // Submit form edit
  const editTaskForm = document.getElementById('editTaskForm');
  editTaskForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editTaskId').value;
    const title = document.getElementById('editTaskTitle').value.trim();

    if (!title) {
      Swal.fire({
        icon: 'warning',
        title: 'Oops!',
        text: 'Judul task tidak boleh kosong.',
        timer: 2000,
        showConfirmButton: false,
        timerProgressBar: true
      });
      return;
    }

    Swal.fire({
      title: 'Simpan perubahan?',
      text: title,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, simpan!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`/todolist/${id}/update`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ title: title })
        })
        .then(response => {
          if (!response.ok) throw new Error('Gagal menyimpan perubahan.');
          return response.json();
        })
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Task berhasil diupdate.',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
          });
          setTimeout(() => location.reload(), 2000);
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal menyimpan perubahan.',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
          });
        });
      }
    });
  });

  // Tombol Hapus
  document.getElementById('btnDeleteSelected').addEventListener('click', () => {
    if (!selectedTask) return;
    const id = selectedTask.dataset.id;
    Swal.fire({
      title: 'Yakin ingin menghapus task ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then(result => {
      if (result.isConfirmed) {
        fetch(`/todolist/${id}/delete`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          }
        })
        .then(response => {
          if (!response.ok) throw new Error('Gagal menghapus task.');
          return response.json();
        })
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Terhapus!',
            text: 'Task berhasil dihapus.',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
          });
          setTimeout(() => location.reload(), 2000);
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal menghapus task.',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
          });
        });
      }
    });
  });

  // Drag & Drop
  const columns = ['todo', 'in_progress', 'done'];
  columns.forEach(status => {
    const el = document.getElementById(status);
    new Sortable(el, {
      group: 'shared',
      animation: 150,
      onEnd: function (evt) {
        const taskId = evt.item.dataset.id;
        const newStatus = evt.to.dataset.status;

        fetch(`/todolist/${taskId}/move`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ status: newStatus })
        });

        const taskEl = evt.item;
        const taskTitle = taskEl.querySelector('.task-title');
        if (taskTitle) {
          const firstSpan = taskTitle.querySelector('span');
          if (firstSpan && firstSpan.textContent.includes('✔️')) {
            firstSpan.remove();
          }
        }
        taskEl.classList.remove('bg-success', 'text-white');
        taskEl.removeAttribute('data-done');

        if (newStatus === 'done') {
          taskEl.classList.add('bg-success', 'text-white');
          taskEl.setAttribute('data-done', 'true');
          if (taskTitle) {
            const check = document.createElement('span');
            check.textContent = '✔️ ';
            taskTitle.prepend(check);
          }
          const canvas = evt.to.closest('.col-md-4').querySelector('.confetti-canvas');
          if (canvas) {
            const myConfetti = confetti.create(canvas, { resize: true });
            myConfetti({
              particleCount: 150,
              spread: 90,
              origin: { y: 0.3 }
            });
          }
        }
      }
    });
  });

  // Tambah Task dengan konfirmasi
  const addTaskForm = document.getElementById('addTaskForm');
  addTaskForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const title = document.getElementById('addTaskTitle').value.trim();

    if (!title) {
      Swal.fire({
        icon: 'warning',
        title: 'Oops!',
        text: 'Judul task tidak boleh kosong.',
        timer: 2000,
        showConfirmButton: false,
        timerProgressBar: true
      });
      return;
    }

    Swal.fire({
      title: 'Tambah task baru?',
      text: title,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, tambah!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        addTaskForm.submit();
      }
    });
  });

});
</script>
@endsection
