@extends('admin.layouts.app')
@section('content')

<div class="main-content side-content pt-0">
<div class="container-fluid">
    <h2 class="my-4">Manage Job Details</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="w-50 alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Job Button --}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addJobModal">
        + Add New Job
    </button>

    {{-- Jobs Table --}}
    <div class="card">
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr. no</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Salary</th>
                        <th>Vacancy</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobDetails as $job)
                    <tr>
                        <td>{{ $loop->iteration }}
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ $job->job_type }}</td>
                        <td>{{ $job->salary }}</td>
                        <td>{{ $job->vacancy }}</td>
                        <td>{{ $job->deadline }}</td>
                        <td>{{ ucfirst($job->status) }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editBtn" 
                                    data-job='@json($job)'>
                                Edit
                            </button>
                <button class="btn btn-info btn-sm viewBtn" 
                         data-job='@json($job)'>
                    View
                </button>


                <form action="{{ route('admin.career-details.destroy', $job->id) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this job?')">
                        Delete
                    </button>
                </form>
            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


{{-- Add Job Modal --}}
<div class="modal fade" id="addJobModal" tabindex="-1" aria-labelledby="addJobModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addJobModalLabel">Add New Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.career-details.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
               
                <div class="col-md-6 mb-3">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Job Type</label>
                    <input type="text" name="job_type" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Job Description</label>
                    <textarea name="job_description" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Responsibilities</label>
                    <textarea name="responsibilities" class="form-control" rows="4"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Skills & Qualifications</label>
                    <textarea name="skills_and_qualifications" class="form-control" rows="4"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Experience</label>
                    <input type="text" name="experience" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Salary</label>
                    <input type="text" name="salary" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Vacancy</label>
                    <input type="number" name="vacancy" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success">Save Job</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="viewJobModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Job Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
            <li class="list-group-item"><b>Title:</b> <span id="viewTitle"></span></li>
            <li class="list-group-item"><b>Location:</b> <span id="viewLocation"></span></li>
            <li class="list-group-item"><b>Job Type:</b> <span id="viewType"></span></li>
            <li class="list-group-item"><b>Description:</b> <span id="viewDesc"></span></li>
            <li class="list-group-item"><b>Responsibilities:</b> <ul id="viewResp"></ul></li>
            <li class="list-group-item"><b>Skills:</b> <ul id="viewSkills"></ul></li>
            <li class="list-group-item"><b>Experience:</b> <span id="viewExp"></span></li>
            <li class="list-group-item"><b>Salary:</b> <span id="viewSalary"></span></li>
            <li class="list-group-item"><b>Vacancy:</b> <span id="viewVacancy"></span></li>
            <li class="list-group-item"><b>Deadline:</b> <span id="viewDeadline"></span></li>
            <li class="list-group-item"><b>Status:</b> <span id="viewStatus"></span></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editJobModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editJobForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" id="editId" name="id">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Title :</label>
                    <input type="text" name="title" id="editTitle" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Location :</label>
                    <input type="text" name="location" id="editLocation" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Job Type :</label>
                    <input type="text" name="job_type" id="editType" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Description :</label>
                    <textarea name="job_description" id="editDesc" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Responsibilities :</label>
                    <textarea name="responsibilities" class="form-control"  rows="4" id="editResp"></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Skills :</label>
                    <textarea name="skills_and_qualifications" class="form-control" rows="4" id="editSkills"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Experience :</label>
                    <input type="text" name="experience" id="editExp" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Salary :</label>
                    <input type="text" name="salary" id="editSalary" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Vacancy :</label>
                    <input type="number" name="vacancy" id="editVacancy" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Deadline :</label>
                    <input type="date" name="deadline" id="editDeadline" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status :</label>
                    <select name="status" id="editStatus" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success">Update Job</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

   // View Job
document.querySelectorAll('.viewBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        let job = JSON.parse(this.dataset.job);

        document.getElementById("viewTitle").innerText = job.title;
        document.getElementById("viewLocation").innerText = job.location;
        document.getElementById("viewType").innerText = job.job_type;
        document.getElementById("viewDesc").innerText = job.job_description;
        document.getElementById("viewExp").innerText = job.experience;
        document.getElementById("viewSalary").innerText = job.salary;
        document.getElementById("viewVacancy").innerText = job.vacancy;
        document.getElementById("viewDeadline").innerText = job.deadline;
        document.getElementById("viewStatus").innerText = job.status;

        // Responsibilities list
        let respList = document.getElementById("viewResp");
        respList.innerHTML = "";
        if (job.responsibilities) {
            job.responsibilities.split("\n").forEach(r => {
                let li = document.createElement("li");
                li.textContent = "• " + r.trim();
                respList.appendChild(li);
            });
        }

        // Skills list
        let skillsList = document.getElementById("viewSkills");
        skillsList.innerHTML = "";
        if (job.skills_and_qualifications) {
            job.skills_and_qualifications.split("\n").forEach(s => {
                let li = document.createElement("li");
                li.textContent = "• " +s.trim();
                skillsList.appendChild(li);
            });
        }

        new bootstrap.Modal(document.getElementById('viewJobModal')).show();
    });
});

// Edit Job
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        let job = JSON.parse(this.dataset.job);

        document.getElementById("editId").value = job.id;
        document.getElementById("editTitle").value = job.title;
        document.getElementById("editLocation").value = job.location;
        document.getElementById("editType").value = job.job_type;
        document.getElementById("editDesc").value = job.job_description;
        document.getElementById("editResp").value = job.responsibilities;
        document.getElementById("editSkills").value = job.skills_and_qualifications;
        document.getElementById("editExp").value = job.experience;
        document.getElementById("editSalary").value = job.salary;
        document.getElementById("editVacancy").value = job.vacancy;
        document.getElementById("editDeadline").value = job.deadline;
        document.getElementById("editStatus").value = job.status;

        document.getElementById("editJobForm").action = "/admin/career-details/edit/" + job.id;

        new bootstrap.Modal(document.getElementById('editJobModal')).show();
    });
});

</script>

@endsection