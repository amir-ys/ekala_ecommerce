<div class="col-12 col-lg-12 px-0 mt-2">
    <div class="side-blog-post">
        <div class="row pl-3">
            <div class="col-4 pl-2">
                <a href="{{ $post->path() }}">
                    <img  src="{{ route('front.blog.image.show' , $post->id) }}" alt="">

                </a>
            </div>
            <div class="col-8 px-0">
                <a href="{{ $post->path() }}">
                    <h2>
                    {{ $post->title }}
                    </h2>
                </a>
                <div class="row">
                    <div class="col-12 col-xl-6 pl-0">
                       <span class="category">دسته بندی: <a
                       href="{{ $post->category?->path() }}">{{ $post->category?->name }}</a></span>
                    </div>
                    <div
                        class="col-12 col-xl-6 pr-0 text-start text-xl-end d-none d-xl-block">
                        <span class="date">{{ $post->getShowDate() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
