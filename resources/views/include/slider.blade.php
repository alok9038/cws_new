
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

</head>
<style>


</style>
<script>
    $(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    items:4,
    autoplay:true,
    margin:20,
    loop:false,
    dots:true,
    smartSpeed: 450,
    autoplayTimeout: 5000,
    autoplayHoverPause:true,
    pagination:true,
    responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1170: {
                        items: 4
                    }
                }
  });
});
</script>
    <div class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>Featured Course</h2>
                        <div class="section-borders">
                            <span class="bg-success"></span>
                            <span class="black-border"></span>
                            <span class="bg-success"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel client-testimonial-carousel py-4">
                        @php
                            $featured_courses = featured_course();
                        @endphp
                        @foreach ($featured_courses as $course)
                        @php
                            $course_id = \Crypt::encrypt($course->id)
                        @endphp
                            <div class="single-testimonial-item card rounded-15 my-3 border-0 cws-shadow">
                                <a href="{{ route('home.course.view',['slug'=>$course->slug, 'id'=>$course_id]) }}" class="text-decoration-none" title="{{ $course->title }}">
                                    <div class="card-img-top rounded-15">
                                        <img src="{{ asset('assets/images/course/'.$course->image) }}" class="img-fluid rounded-15" style="height: 233px;  object-fit:cover;" alt="">
                                    </div>
                                    <div class="card-body">
                                        <p class="h5 text-truncate">{{ $course->title }}</p>
                                        <p class="text-success">₹ {{ $course->discount_price }}<span class="ms-4 text-danger small"><del>₹ {{ $course->price }}</del></span></p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
