<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<script defer>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            autoWidth:false,
            nav:true,
            dots: false,
            navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    })
</script>
<div class="owl-carousel owl-theme">
    @foreach( $banners as $banner )
        <div class="item">
            <a href="{{ $banner['link'] }}" target="_blank">
                <img src="{{ $banner['imagem'] }}">
            </a>
        </div>
    @endforeach
</div>

