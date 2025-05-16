<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.homecss')
    <style>
        .profile-section {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .section-title {
            font-weight: 600;
            font-size: 1.25rem;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .section-item {
            margin-bottom: 8px;
        }

        .add-btn {
            font-size: 0.9rem;
            color: #0d6efd;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .add-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header_section">
        @include('home.header')
    </div>

    <div class="container mt-4 mb-4">
        <h2 class="mb-4">User Profile Details</h2>

        <!-- Work Section -->
<div class="profile-section">
    <div class="section-title">Work</div>

    <div class="section-item">
        <!-- Show the "Add work experience" button whether work experience exists or not -->
        <button class="add-btn" onclick="toggleWorkForm()">Add work experience</button>
    </div>

    @if ($user->workExperiences->isEmpty())
        <div class="section-item">
            No work experience added.
        </div>
    @else
        <div class="section-item">
            <ul>
                @foreach ($user->workExperiences as $workExperience)
                    <li>
                        <strong>{{ $workExperience->workplace_name }}</strong><br>

                        @if ($workExperience->workplace_logo)
                            <img src="{{ asset('storage/' . $workExperience->workplace_logo) }}" alt="Logo" width="50"><br>
                        @endif

                        @if ($workExperience->designation)
                            <p>Designation: {{ $workExperience->designation }}</p>
                        @endif

                        @if ($workExperience->year)
                            <p>Year: {{ $workExperience->year }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

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


   <!-- Education Section -->
<div class="profile-section">
    <div class="section-title">Education</div>

    <!-- College / Higher Education Section -->
    <div class="section-item">
        <h5>Higher Education</h5>

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
            <p>No college education added.</p>
        @else
            <ul>
                @foreach ($collegeEducations as $education)
                    <li>
                        <strong>{{ $education->school_name }}</strong><br>
                        @if ($education->school_logo)
                            <img src="{{ asset('storage/' . $education->school_logo) }}" alt="Logo" width="50">
                        @endif
                        <p>Degree: {{ $education->degree }}</p>
                        <p>Graduation Year: {{ $education->graduation_year }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        <button class="add-btn" onclick="toggleCollegeForm()">Add College</button>
    </div>

    <!-- High School Education Section -->
    <div class="section-item">
        <h5>High School Education</h5>


        @if ($highSchoolEducations->isEmpty())
            <p>No high school education added.</p>
        @else
            <ul>
                @foreach ($highSchoolEducations as $education)
                    <li>
                        <strong>{{ $education->school_name }}</strong><br>
                        @if ($education->school_logo)
                            <img src="{{ asset('storage/' . $education->school_logo) }}" alt="Logo" width="50">
                        @endif
                        <p>Degree: {{ $education->degree }}</p>
                        <p>Graduation Year: {{ $education->graduation_year }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        <button class="add-btn" onclick="toggleHighSchoolForm()">Add High School</button>
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
                        <option value="SSC">HSC</option>
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



       <!-- Places lived -->
<div class="profile-section">
    <div class="section-title">Places Lived</div>

    <div class="section-item">
        <button class="add-btn" onclick="toggleAddressForm()">Edit address</button>
    </div>

    @if ($user->present_address || $user->permanent_address)
        <div class="section-item">
            @if ($user->present_address)
                <p><strong>Present Address:</strong> {{ $user->present_address }}</p>
            @endif
            @if ($user->permanent_address)
                <p><strong>Permanent Address:</strong> {{ $user->permanent_address }}</p>
            @endif
        </div>
    @else
        <div class="section-item">No address added.</div>
    @endif

    <!-- Hidden form -->
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


        <!-- Contact info -->
<div class="profile-section">
    <div class="section-title">Contact Info</div>
    <div class="section-item"><strong>Mobile:</strong> {{ $user->phone ?? 'Not added' }}</div>
    <div class="section-item"><strong>Email:</strong> {{ $user->email }}</div>
    <button class="edit-btn" onclick="toggleContactForm()">Edit Info</button>

    <!-- Inline Edit Form (Initially Hidden) -->
    <div id="contactEditForm" style="display: none; margin-top: 15px;">
        <form method="POST" action="{{ route('profile.update.contact') }}">
            @csrf
            @method('POST')

            <div style="margin-bottom: 10px;">
                <label for="phone"><strong>Mobile:</strong></label><br>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-input">
            </div>

            <div style="margin-bottom: 10px;">
                <label for="email"><strong>Email:</strong></label><br>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input">
            </div>

            <div>
                <button type="submit" class="btn-save">Save</button>
                <button type="button" onclick="toggleContactForm()" class="btn-cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>


        <!-- Basic info -->
<div class="profile-section">
    <div class="section-title">Basic Info</div>

    <div class="section-item">
        <button class="add-btn" onclick="toggleBasicInfoForm()">Edit Basic Info</button>
    </div>

    <div class="section-item"><strong>Gender:</strong> {{ $user->gender ?? 'Not added' }}</div>
    <div class="section-item"><strong>Date of Birth:</strong> {{ $user->dob ?? 'Not added' }}</div>
    <div class="section-item"><strong>Relationship Status:</strong> {{ $user->relationship_status ?? 'Not added' }}</div>

    <!-- Hidden form -->
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
    <div class="section-title">Extra Curricular Activities</div>

    @if($user->extraCurricularActivities && $user->extraCurricularActivities->isNotEmpty())
        @foreach($user->extraCurricularActivities as $activity)
            <div class="section-item border p-3 mb-3 rounded shadow-sm">
                <div class="flex items-center gap-4">
                    @if($activity->logo)
                        <img src="{{ asset('storage/' . $activity->logo) }}" width="50" height="50" class="rounded">
                    @endif
                    <div>
                        <strong>{{ $activity->name }}</strong><br>
                        <small>{{ $activity->time_duration }}</small>
                    </div>
                </div>
                <p class="mt-2">{{ $activity->description }}</p>
                @if($activity->github_link)
                    <p><a href="{{ $activity->github_link }}" target="_blank" class="text-blue-500 underline">GitHub Link</a></p>
                @endif

                <div class="flex gap-2 mt-2">
                    <!-- Edit Button -->
                    <button onclick="openEditActivityModal(
                        {{ $activity->id }},
                        '{{ addslashes($activity->name) }}',
                        '{{ addslashes($activity->time_duration) }}',
                        '{{ addslashes($activity->description) }}',
                        '{{ $activity->github_link }}',
                        '{{ $activity->logo }}'
                    )" class="btn btn-sm btn-primary">Edit</button>

                    <!-- Delete Form -->
                    <form action="{{ route('activity.delete', $activity->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="section-item">No Extra Curricular Activities added.</div>
    @endif

    <!-- Add Button -->
    <button class="add-btn mt-2" onclick="document.getElementById('addActivityModal').style.display='flex'">Add Activity</button>
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

</body>
</html>
