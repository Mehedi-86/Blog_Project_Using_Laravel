<div class="services_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Blog Posts</h1>
        <p class="services_text">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
        </p>
        <div class="services_section_2">
            <div class="row">

                @foreach($post as $post)
                <div class="col-md-4" style="padding:30px">
                    <div>
                        <img src="/postimage/{{ $post->image }}" class="services_img" style="margin-bottom: 20px; width: 100%; height: 200px; object-fit: cover;">
                    </div>
                    <h4>{{ $post->title }}</h4>
                    <p class="text-muted mb-1">
                        Post by <b>{{ $post->name }}</b>
                        <span style="margin-left: 40px; margin-right: 40px;">|</span>
                        <span>👁️ {{ $post->views }} views</span>
                    </p>
                    <div class="btn_main">
                        <a href="#" class="read-more" data-post-id="{{ $post->id }}" data-href="{{ url('post_details', $post->id) }}">Read more</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<!-- AJAX Script -->
<script>
    document.querySelectorAll('.read-more').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const postId = this.getAttribute('data-post-id');
            const href = this.getAttribute('data-href');

            fetch(`/increase-view/${postId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                window.location.href = href;
            });
        });
    });
</script>
