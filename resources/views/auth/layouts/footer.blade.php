<section class="footer-2 section-padding gray-bg">
    <div class="container">

        <div class="footer-btm">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline footer-socials-2 text-center">
                        @foreach ($categories as $category)
                        <li class="list-inline-item"><a href="{{route('category', $category->id)}}">{{$category->title}}</a></li>
                        @if($category->getChildren)
                        @foreach ($category->getChildren as $child)
                        <li class="list-inline-item"><a href="{{route('category', $child->id)}}">{{$child->title}}</a></li>
                        @endforeach
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="copyright text-center ">
                        @ copyright all reserved to <a href="https://themefisher.com/">themefisher.com</a>-2019
                        Distribution <a href="https://themewagon.com">ThemeWagon.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>