<?php

include 'shooting-gallery.php';

function shooting_gallery_preview() {
    include_scripts();
    include_styles();
    ?>

    <body>
        
        <div class="owl-carousel owl-theme">
                
            <div><a href="#" data-featherlight="https://s-media-cache-ak0.pinimg.com/originals/52/42/42/52424229f6e8159f965f68b4329fbff2.jpg"><img style="width:500px;" src="https://s-media-cache-ak0.pinimg.com/originals/52/42/42/52424229f6e8159f965f68b4329fbff2.jpg"></a></div>
    
            <div><a href="#" data-featherlight="http://static.highsnobiety.com/wp-content/uploads/2015/09/british-customs-david-beckham-triumph-bonneville-00.jpg"><img style="width:500px;" src="http://static.highsnobiety.com/wp-content/uploads/2015/09/british-customs-david-beckham-triumph-bonneville-00.jpg"></a></div>
    
            <div><a href="#" data-featherlight="https://s-media-cache-ak0.pinimg.com/originals/39/3d/b9/393db9ad6a5b1aa49565e3968ef978fe.jpg"><img style="width:500px;" src="https://s-media-cache-ak0.pinimg.com/originals/39/3d/b9/393db9ad6a5b1aa49565e3968ef978fe.jpg"></a></div>
    
            <div><a href="#" data-featherlight="http://cdn.hiconsumption.com/wp-content/uploads/2016/04/Triumph-Furiosa-by-British-Customs-6.jpg"><img style="width:500px;" src="http://cdn.hiconsumption.com/wp-content/uploads/2016/04/Triumph-Furiosa-by-British-Customs-6.jpg"></a></div>
    
            <div><a href="#" data-featherlight="http://blog.motorcycle.com.vsassets.com/wp-content/uploads/2014/06/Beckham-Bonnevile-F3Q-2.jpg"><img style="width:500px;" src="http://blog.motorcycle.com.vsassets.com/wp-content/uploads/2014/06/Beckham-Bonnevile-F3Q-2.jpg"></a></div>
    
            <div><a href="#" data-featherlight="http://cdn.silodrome.com/wp-content/uploads/2015/09/David-Beckham-Triumph-Bonneville-15.jpg"><img style="width:500px;" src="http://cdn.silodrome.com/wp-content/uploads/2015/09/David-Beckham-Triumph-Bonneville-15.jpg"></a></div>
    
            <div><a href="#" data-featherlight="http://2.bp.blogspot.com/-0s1efg-HFy0/VkF1yMCRzUI/AAAAAAAAe9w/Xkmp2pN__tA/s1600/Triumph%2BBonneville%2Bby%2BMaria%2BMotorcycles.jpg"><img style="width:500px;" src="http://2.bp.blogspot.com/-0s1efg-HFy0/VkF1yMCRzUI/AAAAAAAAe9w/Xkmp2pN__tA/s1600/Triumph%2BBonneville%2Bby%2BMaria%2BMotorcycles.jpg"></a></div>
    
            <div><a href="#" data-featherlight="http://www.motorcyclistonline.com/sites/motorcyclistonline.com/files/styles/medium_1x_/public/images/2016/04/ilg61.09rightside.jpg?itok=dNdrECOT"><img style="width:500px;" src="http://www.motorcyclistonline.com/sites/motorcyclistonline.com/files/styles/medium_1x_/public/images/2016/04/ilg61.09rightside.jpg?itok=dNdrECOT"></a></div>
    
        </div>

        <script type="text/javascript">
            var j = jQuery.noConflict();
            j(".owl-carousel").owlCarousel({
                navigation: true,
                itemElement: '.views-row',
                itemsMobile: [768,1],
                itemsDesktop: [1500,3],
                rewindNav: false,
                navigationText: false
                });
            });
        </script>
    </body>
    <?php
}