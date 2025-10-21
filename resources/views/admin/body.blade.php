<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>

    
<!-- Welcome Card -->
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 mb-4 text-center shadow-sm" style="border-radius: 12px; ">
                    <h3 class="mb-3" style="font-size: 2rem;"><i class="fa fa-smile-beam me-2"></i>Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mb-2" style="font-size: 1.2rem;">
                        You are logged in as <strong>{{ ucfirst(Auth::user()->usertype) }}</strong>.
                    </p>
                    <p style="font-size: 1.1rem;">
                        Use the dashboard to manage your users, projects, posts, comments, and messages efficiently.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Project Description -->
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 mb-4 shadow-sm" style="border-radius: 12px;">
                    <h4 class="mb-3" style="color: #2575fc; font-weight: 600;">
                        <i class="fa fa-project-diagram me-2"></i>Project Overview
                    </h4>

                    <p style="font-size: 1.1rem; color: #6c757d;">
                        This is a <strong>comprehensive content management and social interaction platform</strong> built on Laravel. 
                        It allows admins and users to manage posts, comments, messages, and profiles efficiently, ensuring smooth operation and moderation.
                    </p><br><br>

                    <p style="font-size: 1.1rem; color: #6c757d; font-weight: 500;">
                        <i class="fa fa-check-circle text-success me-2"></i>Key Features:
                    </p>

                    <div class="row text-start mb-3">
                        <div class="col-md-6 mb-2"><i class="fa fa-user-cog text-primary me-2"></i> User management with roles and permissions</div>
                        <div class="col-md-6 mb-2"><i class="fa fa-file-alt text-success me-2"></i> Post creation, approval, and moderation</div>
                        <div class="col-md-6 mb-2"><i class="fa fa-comments text-warning me-2"></i> Comment tracking and reporting</div>
                        <div class="col-md-6 mb-2"><i class="fa fa-envelope text-danger me-2"></i> Message management and notifications</div>
                        <div class="col-md-6 mb-2"><i class="fa fa-chart-line text-info me-2"></i> Dashboard analytics and recent activity overview</div>
                        <div class="col-md-6 mb-2"><i class="fa fa-book-open text-secondary me-2"></i> Profile management with education, work, and activities</div>
                    </div>

                    <p style="font-size: 1.1rem; color: #868e96; font-weight: 500;">
                        <i class="fa fa-lightbulb text-warning me-2"></i>Future Enhancements:
                    </p>
                    <ul style="color: #868e96; font-size: 1.05rem;">
                        <li>Advanced analytics for user engagement</li>
                        <li>Interactive modules for community interaction</li>
                        <li>Improved reporting and moderation tools</li>
                        <li>AI-assisted content analysis and suggestions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

    
   <!-- Quick Stats -->
<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <!-- Users -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                    <strong>Users</strong>
                    <small>Total registered users</small>
                </div>
            </div>

            <!-- Posts -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-file-alt fa-2x text-success mb-2"></i>
                    <strong>Posts</strong>
                    <small>All posts</small>
                </div>
            </div>

            <!-- Comments -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-comments fa-2x text-warning mb-2"></i>
                    <strong>Comments</strong>
                    <small>Recent feedback</small>
                </div>
            </div>

            <!-- Connections -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-handshake fa-2x text-danger mb-2"></i>
                    <strong>Connections</strong>
                    <small>Active links</small>
                </div>
            </div>

            <!-- Extra Stats -->
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-bell fa-2x text-info mb-2"></i>
                    <strong>Notifications</strong>
                    <small>Recent alerts</small>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-star fa-2x text-warning mb-2"></i>
                    <strong>Achievements</strong>
                    <small>Completed milestones</small>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-tasks fa-2x text-success mb-2"></i>
                    <strong>Tasks</strong>
                    <small>Pending activities</small>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                    <i class="fa fa-comments-dollar fa-2x text-danger mb-2"></i>
                    <strong>Revenue</strong>
                    <small>Estimated earnings</small>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Recent Activities -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-3 mb-4 shadow-sm">
                        <h5 class="mb-3">Recent Users</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($recentUsers ?? [] as $user)
                                <li>{{ $user->name }} ({{ $user->email }})</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card p-3 mb-4 shadow-sm">
                        <h5 class="mb-3">Recent Comments</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($recentComments ?? [] as $comment)
                                <li><strong>{{ $comment->user->name }}:</strong> {{ Str::limit($comment->content, 50) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-3 mb-4 shadow-sm">
                        <h5 class="mb-3">Recent Posts</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($recentPosts ?? [] as $post)
                                <li>{{ $post->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card p-3 mb-4 shadow-sm">
                        <h5 class="mb-3">Recent Messages</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($recentMessages ?? [] as $message)
                                <li><strong>{{ $message->sender->name }}:</strong> {{ Str::limit($message->content, 50) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips / Announcements -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-3 mb-4 shadow-sm">
                        <h5 class="mb-3">Quick Tips & Announcements</h5>
                        <ul class="mb-0">
                            <li>Review new posts and comments daily.</li>
                            <li>Respond to messages promptly to engage users.</li>
                            <li>Regularly check user activity for moderation.</li>
                            <li>Update site content and settings as needed.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
