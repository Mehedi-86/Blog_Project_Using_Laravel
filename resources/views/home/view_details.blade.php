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

    .icon-dark {
        color: #343a40;
    }

</style>

</head>
<body>
    <!-- Header -->
    <div class="header_section" style="margin-bottom: 30px;">
        @include('home.header')
    </div>

    <div class="container mb-5" >
        <div class="row align-items-center mb-4">
            <div class="col text-start">
                <a href="{{ route('user.view', ['id' => $user->id]) }}" class="btn shadow-sm rounded-circle px-2 py-1" style="background-color: #e9ecef; color: #495057; border: 1px solid #ced4da;"> <i class="fas fa-arrow-left"></i></a>
            </div>
        <div class="col text-center">
            <h3 class="display-6 fw-bold mb-0 icon-dark" style="font-size: 2rem;">
                <i class="bi bi-person-circle me-2"></i> User Details
            </h3>
        </div>
        <div class="col"><!-- Empty column to balance layout --></div>
    </div>

        <!-- Work Section -->
<div class="profile-section">

   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-briefcase me-3 icon-dark"></i>Work</div>

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
                </li>
            @endforeach
            </ul>
        </div>
    @endif
 </div>


   <!-- Education Section -->
<div class="profile-section">
   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-graduation-cap me-3 icon-dark"></i> Education</div>

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
                    </li>
                @endforeach
            </ul>
        @endif

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
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

     <!-- Places Lived -->
<div class="profile-section">
  <div class="section-title fw-bold mb-3 fs-4"> <i class="fas fa-map-marker-alt me-3 icon-dark"></i> Places Lived</div>

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
                </li>
            </ul>
        </div>
    @else
        <div class="section-item fs-6 fw-semibold d-flex justify-content-between align-items-center">
            No address added.
        </div>
    @endif
</div>


      <!-- Contact Info -->
<div class="profile-section">
  <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-phone-alt me-3 icon-dark"></i> Contact Info</div>

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
                </li>
            </ul>
        </div>
    @else
        <div class="section-item fs-6 fw-semibold">
            No contact info added.
        </div>
    @endif
</div>


      <!-- Basic Info -->
<div class="profile-section">
   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-user-tag me-3 icon-dark"></i> Basic Info</div>

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
                </li>
            </ul>
        </div>
    @else
        <div class="section-item fs-6 fw-semibold d-flex justify-content-between align-items-center">
            No basic info added.
        </div>
    @endif
</div>


      <!-- Extra Curricular Activities -->
<div class="profile-section">
   <div class="section-title fw-bold mb-3 fs-4"><i class="fas fa-medal me-3 icon-dark"></i> Extra Curricular Activities</div>


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
                                    <i class="fab fa-github me-1 icon-dark"></i> GitHub Link
                                </a>
                            </div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="section-item fs-6 fw-semibold">No Extra Curricular Activities added.</div>
    @endif
</div>

</div>

    <!-- Footer -->
    @include('home.footer')

</body>
</html>