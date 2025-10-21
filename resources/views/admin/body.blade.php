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
                <div class="card p-4 mb-4 text-center shadow-sm" style="border-radius: 12px;">
                    <h3 class="mb-3" style="font-size: 2rem;">Welcome, {{ Auth::user()->name }}!</h3>
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


    <!-- Quick Stats -->
    <section class="no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                        <strong>Users</strong>
                        <div class="number dashtext-1">{{ $totalUsers ?? 0 }}</div>
                        <small>Total registered users</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                        <i class="fa fa-file-alt fa-2x text-success mb-2"></i>
                        <strong>Posts</strong>
                        <div class="number dashtext-2">{{ $totalPosts ?? 0 }}</div>
                        <small>All posts</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                        <i class="fa fa-comments fa-2x text-warning mb-2"></i>
                        <strong>Comments</strong>
                        <div class="number dashtext-3">{{ $totalComments ?? 0 }}</div>
                        <small>Recent feedback</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="statistic-block block text-center p-3 mb-4 shadow-sm" style="border-radius: 10px;">
                        <i class="fa fa-handshake fa-2x text-danger mb-2"></i>
                        <strong>Connections</strong>
                        <div class="number dashtext-4">{{ $totalConnections ?? 0 }}</div>
                        <small>Active links</small>
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
