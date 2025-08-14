@extends('admin.layouts.app')

@section('content')
<div class="container main-content side-content pt-5" style="margin-left: 20em;">
    <h2>Admin Notifications</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#notificationModal">
        Add Notification
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sr no.</th>
                <th>Title</th>
                <th>Body</th>
                <th>Send At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notif)
                <tr id="notif-row-{{ $notif->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $notif->title }}</td>
                    <td>{{ $notif->body }}</td>
                    <td>{{ $notif->send_at }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" 
                                data-id="{{ $notif->id }}"
                                data-title="{{ $notif->title }}"
                                data-body="{{ $notif->body }}"
                                data-send_at="{{ $notif->send_at }}">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $notif->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="notificationForm">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="notificationModalLabel">Create Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Body</label>
                  <textarea name="body" class="form-control" rows="4" required></textarea>
              </div>
              <div class="form-group">
                  <label>Send At</label>
                  <input type="datetime-local" name="send_at" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit Notification Modal -->
<div class="modal fade" id="editNotificationModal" tabindex="-1" role="dialog" aria-labelledby="editNotificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editNotificationForm">
        @csrf
        <input type="hidden" name="id" id="edit-id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editNotificationModalLabel">Edit Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="edit-title" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Body</label>
                  <textarea name="body" id="edit-body" class="form-control" rows="4" required></textarea>
              </div>
              <div class="form-group">
                  <label>Send At</label>
                  <input type="datetime-local" name="send_at" id="edit-send_at" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  </div>
</div>

<script>
// Add Notification
document.getElementById('notificationForm').addEventListener('submit', function(e){
    e.preventDefault();
    fetch("{{ route('admin.notifications.store') }}", {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            
            location.reload();
        }
    });
});

// Open Edit Modal
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-title').value = this.dataset.title;
        document.getElementById('edit-body').value = this.dataset.body;
        document.getElementById('edit-send_at').value = this.dataset.send_at.replace(' ', 'T');
        $('#editNotificationModal').modal('show');
    });
});

// Update Notification
document.getElementById('editNotificationForm').addEventListener('submit', function(e){
    e.preventDefault();
    let id = document.getElementById('edit-id').value;
    fetch(`/admin/notifications/${id}/update`, {
        method: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
           
            location.reload();
        }
    });
});

// Delete Notification
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        if(confirm("Are you sure you want to delete this notification?")){
            let id = this.dataset.id;
            fetch(`/admin/notifications/${id}/delete`, {
                method: "DELETE",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    
                    document.getElementById('notif-row-'+id).remove();
                }
            });
        }
    });
});
</script>
@endsection
