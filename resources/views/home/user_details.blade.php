<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.homecss')
    <style>
    .profile-section {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        color: #495057; /* Gray text color */
        transition: box-shadow 0.3s ease;
    }

    .profile-section:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-weight: 600;
        font-size: 1.35rem;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 12px;
        margin-bottom: 20px;
        color: #343a40; /* Darker gray for section titles */
    }

    .section-item {
        margin-bottom: 12px;
        color: #495057; /* Medium gray */
    }

    .add-btn {
        font-size: 0.95rem;
        font-weight: 500;
        color: #6c757d; /* Gray-blue */
        background: none;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .add-btn:hover {
        color: #495057;
        text-decoration: underline;
        background-color: rgba(108, 117, 125, 0.05); /* light gray hover */
    }

    .add-btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(108, 117, 125, 0.25);
    }
</style>

</head>
<body>
    <!-- Header -->
    <div class="header_section" style="margin-bottom: 30px;">
        @include('home.header')
    </div>

    <div class="container mb-5" >
       <h3 class="mb-4 text-center display-6 fw-bold" style="font-size: 2rem; color: #343a40;">
            <i class="bi bi-person-circle me-2"></i> Profile Details
        </h3>

        <!-- Work Section -->
<div class="profile-section">

   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-briefcase me-3" style="color: #343a40;"></i>Work</div>

    @if ($user->workExperiences->isEmpty())
        <div class="section-item fs-6 fw-semibold">
            No work experience added.
        </div>
    @else
        <div class="section-item">
            <ul class="list-group">
            @foreach ($user->workExperiences as $workExperience)
                <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                    <div class="ms-2 me-auto fs-6">
                        <div class="fw-bold">{{ $workExperience->workplace_name }}</div>

                        @if ($workExperience->workplace_logo)
                            <img src="{{ asset('storage/' . $workExperience->workplace_logo) }}" alt="Logo" width="70" class="mb-2 mt-3">
                        @endif

                        @if ($workExperience->designation)
                            <div><strong>Designation:</strong> {{ $workExperience->designation }}</div>
                        @endif

                        @if ($workExperience->year)
                            <div><strong>Year:</strong> {{ $workExperience->year }}</div>
                        @endif
                    </div>

                    <div class="d-flex align-items-start gap-5">
                        <!-- Edit Icon Button -->
                        <button onclick="openEditWorkModal({{ $workExperience->id }}, '{{ addslashes($workExperience->workplace_name) }}', '{{ addslashes($workExperience->designation) }}', '{{ addslashes($workExperience->year) }}', '{{ $workExperience->workplace_logo }}')" 
                          class="text-gray-500 hover:text-gray-800" title="Edit">
                            <i class="fas fa-pen fa"></i>
                        </button>

                        <!-- Delete Icon Button -->
                        <form action="{{ route('user.work.delete', $workExperience->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this work experience?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                <i class="fas fa-trash-alt fa"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    @endif

    <div class="section-item">
        <!-- Show the "Add work experience" button whether work experience exists or not -->
        <button class="add-btn" onclick="toggleWorkForm()">Add work experience</button>
    </div>


    <!-- Hidden form for adding work -->
    <div id="workForm" style="display: none; margin-top: 10px;">
        <form action="{{ route('user.add.work') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="workplace_name" class="form-label">Workplace Name:</label>
                <input type="text" name="workplace_name" id="workplace_name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label for="workplace_logo" class="form-label">Logo:</label>
                <input type="file" name="workplace_logo" id="workplace_logo" class="form-control" accept="image/*">
            </div>

            <div class="mb-2">
                <label for="designation" class="form-label">Designation:</label>
                <textarea name="designation" id="designation" class="form-control" placeholder="e.g., Software Engineer, Lecturer"></textarea>
            </div>

            <div class="mb-2">
                <label for="year" class="form-label">Year:</label>
                <input type="text" name="year" id="year" class="form-control" placeholder="e.g., 2018 to 2022 or 2020 to Present">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
</div>

<!-- Edit Work Modal -->
<div id="editWorkModal" style="display:none;" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Edit Work Experience</h3>
        <form method="POST" id="editWorkForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="editWorkId">

            <label>Workplace Name:</label>
            <input type="text" name="workplace_name" id="editWorkplaceName" class="form-control mb-2" required>

            <label>Current Logo:</label>
            <div id="currentWorkLogoContainer" class="mb-2">
                <img id="currentWorkLogo" src="" width="80" class="rounded">
            </div>

            <label>New Logo (optional):</label>
            <input type="file" name="workplace_logo" class="form-control mb-2">

            <label>Designation:</label>
            <textarea name="designation" id="editDesignation" class="form-control mb-2"></textarea>

            <label>Year:</label>
            <input type="text" name="year" id="editYear" class="form-control mb-4">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('editWorkModal').style.display='none'" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>


   <!-- Education Section -->
<div class="profile-section">
   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-graduation-cap me-3" style="color: #343a40;"></i> Education</div>

    <!-- College / Higher Education Section -->
    <div class="section-item">
        <h5 class="fw-semibold fs-6">Higher Education</h5>

        @php
            $highSchoolDegrees = ['high school', 'ssc', 'hsc', 'science', 'arts', 'commerce'];

            $highSchoolEducations = $user->educations->filter(function ($edu) use ($highSchoolDegrees) {
                return in_array(strtolower($edu->degree), $highSchoolDegrees);
            });

            $collegeEducations = $user->educations->filter(function ($edu) use ($highSchoolDegrees) {
                return !in_array(strtolower($edu->degree), $highSchoolDegrees);
            });
        @endphp

        @if ($collegeEducations->isEmpty())
            <div class="section-item fs-6 fw-semibold">No college education added.</div>
        @else
            <ul class="list-group">
                @foreach ($collegeEducations as $education)
                    <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                        <div class="ms-2 me-auto fs-6">
                            <div class="fw-bold">{{ $education->school_name }}</div>

                            @if ($education->school_logo)
                                <img src="{{ asset('storage/' . $education->school_logo) }}" alt="Logo" width="70" class="mb-2 mt-3">
                            @endif

                            <div><strong>Degree:</strong> {{ $education->degree }}</div>
                            <div><strong>Graduation Year:</strong> {{ $education->graduation_year }}</div>
                        </div>

                        <div class="d-flex align-items-start gap-5">
                            <button onclick='openEditEducationModal({{ $education->id }}, {{ json_encode($education->school_name) }}, {{ json_encode($education->degree) }}, {{ json_encode($education->graduation_year) }}, "{{ $education->school_logo }}")' 
                               class="text-gray-500 hover:text-gray-800" title="Edit">
                                <i class="fas fa-pen fa"></i>
                            </button>

                            <form action="{{ route('user.education.delete', $education->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this education entry?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                    <i class="fas fa-trash-alt fa"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <button class="add-btn mt-2" onclick="toggleCollegeForm()">Add College</button>
    </div>

    <!-- Hidden Form for Adding College -->
    <div id="collegeForm" style="display: none; margin-top: 10px;">
        <form action="{{ route('user.add.education') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="college_school_name" class="form-label">College Name:</label>
                <input type="text" name="school_name" id="college_school_name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label for="school_logo" class="form-label">Logo:</label>
                <input type="file" name="school_logo" id="school_logo" class="form-control" accept="image/*">
            </div>

            <div class="mb-2">
                <label for="degree" class="form-label">Degree:</label>
                <select name="degree" id="degree" class="form-control" required>
                    <option value="">-- Select Degree --</option>
                    <option value="B.Sc">B.Sc</option>
                    <option value="M.Sc">M.Sc</option>
                    <option value="PhD">PhD</option>
                    <option value="B.A.">B.A.</option>
                    <option value="M.A.">M.A.</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="graduation_year" class="form-label">Graduation Year:</label>
                <input type="text" name="graduation_year" id="graduation_year" class="form-control" required placeholder="Enter Year or 'Present'">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>


    <!-- High School Education Section -->
    <div class="section-item mt-4">
        <h5 class="fw-semibold fs-6">High School Education</h5>

        @if ($highSchoolEducations->isEmpty())
            <div class="section-item fs-6 fw-semibold">No high school education added.</div>
        @else
            <ul class="list-group">
                @foreach ($highSchoolEducations as $education)
                    <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                        <div class="ms-2 me-auto fs-6">
                            <div class="fw-bold">{{ $education->school_name }}</div>

                            @if ($education->school_logo)
                                <img src="{{ asset('storage/' . $education->school_logo) }}" alt="Logo" width="70" class="mb-2 mt-3">
                            @endif

                            <div><strong>Degree:</strong> {{ $education->degree }}</div>
                            <div><strong>Graduation Year:</strong> {{ $education->graduation_year }}</div>
                        </div>

                        <div class="d-flex align-items-start gap-5">
                            <button onclick='openEditEducationModal({{ $education->id }}, {{ json_encode($education->school_name) }}, {{ json_encode($education->degree) }}, {{ json_encode($education->graduation_year) }}, "{{ $education->school_logo }}")' 
                                class="text-gray-500 hover:text-gray-800" title="Edit">
                                <i class="fas fa-pen fa"></i>
                            </button>

                            <form action="{{ route('user.education.delete', $education->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this education entry?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                    <i class="fas fa-trash-alt fa"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <button class="add-btn mt-2" onclick="toggleHighSchoolForm()">Add High School</button>
    </div>


    <!-- Edit Education Modal -->
<div id="editEducationModal" style="display:none;" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Edit Education</h3>
        <form method="POST" id="editEducationForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="editEducationId">

            <label>School Name:</label>
            <input type="text" name="school_name" id="editSchoolName" class="form-control mb-2" required>

            <label>Current Logo:</label>
            <div id="currentSchoolLogoContainer" class="mb-2">
                <img id="currentSchoolLogo" src="" width="80" class="rounded">
            </div>

            <label>New Logo (optional):</label>
            <input type="file" name="school_logo" class="form-control mb-2">

            <label>Degree:</label>
            <input type="text" name="degree" id="editDegree" class="form-control mb-2">

            <label>Graduation Year:</label>
            <input type="text" name="graduation_year" id="editGraduationYear" class="form-control mb-4">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('editEducationModal').style.display='none'" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

    <!-- Hidden Form for Adding High School -->
    <div id="highSchoolForm" style="display: none; margin-top: 10px;">
        <form action="{{ route('user.add.education') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="high_school_name" class="form-label">High School Name:</label>
                <input type="text" name="school_name" id="high_school_name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label for="school_logo" class="form-label">Logo:</label>
                <input type="file" name="school_logo" id="school_logo" class="form-control" accept="image/*">
            </div>

            <div class="mb-2">
                <label for="high_school_degree" class="form-label">Degree:</label>
                    <select name="degree" id="high_school_degree" class="form-control" required>
                        <option value="">-- Select Degree --</option>
                        <option value="Science">Science</option>
                        <option value="Arts">Arts</option>
                        <option value="Commerce">Commerce</option>
                        <option value="SSC">SSC</option>
                        <option value="HSC">HSC</option>
                        <option value="High School">High School</option>
                    </select>
            </div>


            <div class="mb-2">
                <label for="graduation_year" class="form-label">Graduation Year:</label>
                <input type="text" name="graduation_year" id="graduation_year" class="form-control" required placeholder="Enter Year or 'Present'">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
</div>



     <!-- Places Lived -->
<div class="profile-section">
  <div class="section-title fw-bold mb-3 fs-4"> <i class="fas fa-map-marker-alt me-3" style="color: #343a40;"></i> Places Lived</div>

    @if ($user->present_address || $user->permanent_address)
        <div class="section-item">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                    <div class="ms-2 me-auto fs-6">
                        @if ($user->present_address)
                            <div style="margin-bottom: 0.5rem"><strong>Present Address:</strong> {{ $user->present_address }}</div>
                        @endif

                        @if ($user->permanent_address)
                            <div><strong>Permanent Address:</strong> {{ $user->permanent_address }}</div>
                        @endif
                    </div>

                    <div class="d-flex align-items-start gap-5">
                        <!-- Edit Button -->
                        <button onclick="toggleAddressForm()" class="text-gray-500 hover:text-gray-800" title="Edit">
                            <i class="fas fa-pen fa"></i>
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('user.delete.address') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your address?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                <i class="fas fa-trash-alt fa"></i>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @else
        <div class="section-item fs-6 fw-semibold d-flex justify-content-between align-items-center">
            No address added.

            <!-- Edit Button always visible even if no address -->
            <button onclick="toggleAddressForm()" class="text-gray-500 hover:text-gray-800 ms-auto" title="Add Address">
                <i class="fas fa-pen fa"></i>
            </button>
        </div>
    @endif

    <!-- Inline Edit Form -->
    <div id="addressForm" style="display: none; margin-top: 10px;">
        <form action="{{ route('user.update.address') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="present_address" class="form-label">Present Address:</label>
                <input type="text" name="present_address" id="present_address" class="form-control" value="{{ old('present_address', $user->present_address) }}">
            </div>

            <div class="mb-2">
                <label for="permanent_address" class="form-label">Permanent Address:</label>
                <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{ old('permanent_address', $user->permanent_address) }}">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
</div>


      <!-- Contact Info -->
<div class="profile-section">
  <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-phone-alt me-3" style="color: #343a40;"></i> Contact Info</div>

    @if ($user->phone || $user->email)
        <div class="section-item">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                    <div class="ms-2 me-auto fs-6">
                        @if ($user->phone)
                            <div style="margin-bottom: 0.5rem;"><strong>Mobile:</strong> {{ $user->phone }}</div>
                        @endif

                        @if ($user->email)
                            <div><strong>Email:</strong> {{ $user->email }}</div>
                        @endif
                    </div>

                    <div class="d-flex align-items-start gap-5">
                        <!-- Edit Icon Button -->
                        <button onclick="toggleContactForm()" class="text-gray-500 hover:text-gray-800" title="Edit Contact Info">
                            <i class="fas fa-pen fa"></i>
                        </button>

                        <!-- Delete Icon Button -->
                        <form action="{{ route('profile.delete.contact') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your contact info?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Contact Info">
                                <i class="fas fa-trash-alt fa"></i>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @else
        <div class="section-item fs-6 fw-semibold">
            No contact info added.
        </div>
    @endif

    <!-- Inline Edit Form -->
    <div id="contactEditForm" style="display: none; margin-top: 10px;">
        <form method="POST" action="{{ route('profile.update.contact') }}">
            @csrf

            <div class="mb-2">
                <label for="phone" class="form-label"><strong>Mobile:</strong></label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            </div>

            <div class="mb-2">
                <label for="email" class="form-label"><strong>Email:</strong></label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
</div>


      <!-- Basic Info -->
<div class="profile-section">
   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-user-tag me-3" style="color: #343a40;"></i> Basic Info</div>

    @if ($user->gender || $user->dob || $user->relationship_status)
        <div class="section-item">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
                    <div class="ms-2 me-auto fs-6">
                        @if ($user->gender)
                            <div style="margin-bottom: 0.5rem;"><strong>Gender:</strong> {{ $user->gender }}</div>
                        @endif

                        @if ($user->dob)
                            <div style="margin-bottom: 0.5rem;"><strong>Date of Birth:</strong> {{ $user->dob }}</div>
                        @endif

                        @if ($user->relationship_status)
                            <div><strong>Relationship Status:</strong> {{ $user->relationship_status }}</div>
                        @endif
                    </div>

                    <div class="d-flex align-items-start gap-5">
                        <!-- Edit Icon Button -->
                        <button onclick="toggleBasicInfoForm()" class="text-gray-500 hover:text-gray-800" title="Edit Basic Info">
                            <i class="fas fa-pen fa"></i>
                        </button>

                        <!-- Delete Icon Button -->
                        <form action="{{ route('user.delete.basicinfo') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your basic info?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Basic Info">
                                <i class="fas fa-trash-alt fa"></i>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @else
        <div class="section-item fs-6 fw-semibold d-flex justify-content-between align-items-center">
            No basic info added.

            <!-- Edit icon always visible -->
            <button onclick="toggleBasicInfoForm()" class="text-gray-500 hover:text-gray-800 ms-auto" title="Add Basic Info">
                <i class="fas fa-pen fa"></i>
            </button>
        </div>
    @endif

    <!-- Inline Edit Form -->
    <div id="basicInfoForm" style="display: none; margin-top: 10px;">
        <form action="{{ route('user.update.basicinfo') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">-- Select Gender --</option>
                    <option value="Male" {{ $user->gender === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $user->gender === 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ $user->gender === 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" name="dob" id="dob" class="form-control" value="{{ $user->dob }}">
            </div>

            <div class="mb-2">
                <label for="relationship_status" class="form-label">Relationship Status:</label>
                <select name="relationship_status" id="relationship_status" class="form-control">
                    <option value="">-- Select Status --</option>
                    <option value="Single" {{ $user->relationship_status === 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="In a Relationship" {{ $user->relationship_status === 'In a Relationship' ? 'selected' : '' }}>In a Relationship</option>
                    <option value="Married" {{ $user->relationship_status === 'Married' ? 'selected' : '' }}>Married</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
    </div>
</div>


      <!-- Extra Curricular Activities -->
<div class="profile-section">
   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-medal me-3" style="color: #343a40;"></i> Extra Curricular Activities</div>


    @if($user->extraCurricularActivities && $user->extraCurricularActivities->isNotEmpty())
        <ul class="list-group">
            @foreach($user->extraCurricularActivities as $activity)
                <li class="list-group-item d-flex justify-content-between align-items-start mb-3 shadow-sm rounded border">
                    <div class="ms-2 me-auto">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            @if($activity->logo)
                                <img src="{{ asset('storage/' . $activity->logo) }}" width="75" height="75" class="rounded">
                            @endif
                            <div class="fs-6">
                                <strong>{{ $activity->name }}</strong><br>
                                <small>{{ $activity->time_duration }}</small>
                            </div>
                        </div>
                        <div class="fs-6">{{ $activity->description }}</div>
                        @if($activity->github_link)
                            <div class="mt-1">
                                <a href="{{ $activity->github_link }}" target="_blank" class="text-primary">
                                    <i class="fab fa-github me-1" style="color: #343a40;"></i> GitHub Link
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-start gap-5">
                        <!-- Edit Icon -->
                        <button onclick="openEditActivityModal(
                            {{ $activity->id }},
                            '{{ addslashes($activity->name) }}',
                            '{{ addslashes($activity->time_duration) }}',
                            '{{ addslashes($activity->description) }}',
                            '{{ $activity->github_link }}',
                            '{{ $activity->logo }}'
                        )" 
                           class="text-gray-500 hover:text-gray-800" title="Edit Activity">
                           <i class="fas fa-pen fa"></i>
                        </button>

                        <!-- Delete Icon -->
                        <form action="{{ route('activity.delete', $activity->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger border-0 bg-transparent p-0" title="Delete Activity">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="section-item fs-6 fw-semibold">No Extra Curricular Activities added.</div>
    @endif

    <!-- Add Button -->
    <button class="add-btn mt-3" onclick="document.getElementById('addActivityModal').style.display='flex'">Add Activity</button>
</div>



<!-- Add Activity Modal -->
<div id="addActivityModal" style="display:none;" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Add Activity</h3>
        <form method="POST" action="{{ route('activity.add') }}" enctype="multipart/form-data">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" class="form-input w-full mb-2" required>

            <label>Logo:</label>
            <input type="file" name="logo" class="form-input w-full mb-2">

            <label>Duration:</label>
            <input type="text" name="duration" class="form-input w-full mb-2" placeholder="e.g. 2022 to Present" required>

            <label>Description:</label>
            <textarea name="description" class="form-input w-full mb-2" rows="3" required></textarea>

            <label>GitHub Link (optional):</label>
            <input type="url" name="github_link" class="form-input w-full mb-4">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('addActivityModal').style.display='none'" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Activity Modal -->
<div id="editActivityModal" style="display:none;" class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Edit Activity</h3>
        <form method="POST" id="editActivityForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="editActivityId">

            <label>Name:</label>
            <input type="text" name="name" id="editActivityName" class="form-input w-full mb-2" required>

           <!-- Current Logo Preview -->
            <div id="currentLogoContainer" class="mb-2" style="display: none;">
                <label>Current Logo:</label><br>
                <img id="currentLogo" src="" alt="Current Logo" width="80" class="rounded">
            </div>

            <label>Logo (optional):</label>
            <input type="file" name="logo" class="form-input w-full mb-2">


            <label>Duration:</label>
            <input type="text" name="time_duration" id="editActivityDuration" class="form-input w-full mb-2" required>

            <label>Description:</label>
            <textarea name="description" id="editActivityDescription" class="form-input w-full mb-2" rows="3" required></textarea>

            <label>GitHub Link:</label>
            <input type="url" name="github_link" id="editActivityGithub" class="form-input w-full mb-4">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('editActivityModal').style.display='none'" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

    </div>

    <!-- Footer -->
    @include('home.footer')

    <script>
    function toggleWorkForm() {
        var form = document.getElementById('workForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>

<!-- Optional JS to toggle form visibility -->
<script>
    function toggleCollegeForm() {
        const form = document.getElementById('collegeForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function toggleHighSchoolForm() {
        const form = document.getElementById('highSchoolForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

<script>
    function toggleAddressForm() {
        const form = document.getElementById('addressForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

<script>
    function toggleBasicInfoForm() {
        const form = document.getElementById('basicInfoForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

<!-- JS to toggle the inline form -->
<script>
    function toggleContactForm() {
        const form = document.getElementById('contactEditForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>

<!-- JavaScript to Populate Edit Modal -->
<script>
function openEditActivityModal(id, name, time_duration, description, github_link, logo) {
    const form = document.getElementById('editActivityForm');
    form.action = `/profile/activity/${id}/update`;

    document.getElementById('editActivityId').value = id;
    document.getElementById('editActivityName').value = name;
    document.getElementById('editActivityDuration').value = time_duration;
    document.getElementById('editActivityDescription').value = description;
    document.getElementById('editActivityGithub').value = github_link ?? '';

    // Set logo preview
    const logoContainer = document.getElementById('currentLogoContainer');
    const logoImg = document.getElementById('currentLogo');
    if (logo) {
        logoImg.src = `/storage/${logo}`;
        logoContainer.style.display = 'block';
    } else {
        logoImg.src = '';
        logoContainer.style.display = 'none';
    }

    document.getElementById('editActivityModal').style.display = 'flex';
}

</script>

<script>
    function openEditWorkModal(id, name, designation, year, logo) {
        const form = document.getElementById('editWorkForm');
        form.action = `/profile/work/${id}/update`; // Ensure this route exists

        document.getElementById('editWorkId').value = id;
        document.getElementById('editWorkplaceName').value = name;
        document.getElementById('editDesignation').value = designation;
        document.getElementById('editYear').value = year;

        const logoUrl = `/storage/${logo}`;
        document.getElementById('currentWorkLogo').src = logoUrl;

        document.getElementById('editWorkModal').style.display = 'flex';
    }
</script>

<script>
function openEditEducationModal(id, schoolName, degree, graduationYear, logoPath) {
    document.getElementById('editEducationForm').action = `/profile/education/${id}/update`;
    document.getElementById('editEducationId').value = id;
    document.getElementById('editSchoolName').value = schoolName;
    document.getElementById('editDegree').value = degree;
    document.getElementById('editGraduationYear').value = graduationYear;

    if (logoPath) {
        document.getElementById('currentSchoolLogo').src = `/storage/${logoPath}`;
        document.getElementById('currentSchoolLogoContainer').style.display = 'block';
    } else {
        document.getElementById('currentSchoolLogoContainer').style.display = 'none';
    }

    document.getElementById('editEducationModal').style.display = 'flex';
}
</script>

</body>
</html>