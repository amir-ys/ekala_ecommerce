<div class="col">
    <div class="blog-post-box" data-aos="fade-up"
         data-aos-duration="1000">
        <a href="{{ route('front.blog.showPost' , $post->slug) }}">
            <div class="post-image">
                <img src="{{ route('front.blog.image.show' , $post->id) }}" alt="">
            </div>
        </a>
        <div class="details py-3 px-4 mt-md-4">
            <div class="post-date">ارسال شده در {{ $post->getShowDate() }} </div>
            <a href="{{ route('front.blog.showPost' , $post->slug )}}">
                <h2 class="post-title">{{ $post->title }}</h2>
            </a>
            <a href="{{ route('front.blog.showPost' , $post->slug) }}">
                <div class="post-description">
                    {!! $post->summary !!}
                </div>
            </a>
            <div class="read-more"><a href="{{ route('front.blog.showPost' , $post->slug) }}"
                                      class="hvr-icon-back">بیشتر خوانید ...
                    <i class="fa fa-arrow-left hvr-icon"></i></a>
            </div>
        </div>
    </div>
</div>
