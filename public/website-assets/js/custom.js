
function showLoading() {
    var spinner = document.getElementById('loadingSpinner'); 
    spinner.style.display = 'block';
}
jQuery(document).ready(function () {
    // Tooplip job detail
    if (jQuery('.quickview-job-hide').length) {
        var the_popovers = [];
        jQuery(".quickview-job-hide").each(function (key, val) {
            var the_popover = jQuery(val).popover({
                html : true,
                trigger: 'hover',
                content: function() {
                  var content = jQuery(val).closest('.job-block').find('.box-job-quick-view-tooltip').html();
                  return content;
                }
            });

            the_popovers.push(the_popover);
            jQuery(val).closest('.job-block').find('.quickview-job').on('mouseenter',function(){
                the_popovers[key].popover('show');
            })
        })

        jQuery('body').on('mouseenter','.popover',function(){
            jQuery('body').addClass('c-popover-active')
        });
        jQuery('body').on('mouseleave','.popover',function(){
            if(jQuery('.popover').length){
                jQuery('body').removeClass('c-popover-active')
                jQuery('.popover').remove();
            }
        });
        jQuery('body').on('mouseleave','.job-block',function(){
            setTimeout(() => {
                if( !jQuery('body').hasClass('c-popover-active') ){
                    jQuery('.popover').remove();
                }
            }, 100);
        });
        
    }
});



new Swiper(".jobCategoriesSwiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
new Swiper(".mySwiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
new Swiper(".featureJobsSwiper", {
    navigation: {
        nextEl: ".btn-feature-jobs-next",
        prevEl: ".btn-feature-jobs-pre",
    },
    effect: "slide",
});
new Swiper(".attractiveJobsSwiper", {
    navigation: {
        nextEl: ".btn-attractive-jobs-next",
        prevEl: ".btn-attractive-jobs-pre",
    },
    effect: "slide",
});

jQuery( document ).ready( function(){
    jQuery('#advanceSearchBtn').on('click',function(){
        jQuery('#advanceSearch').toggle('slow')
    })
})