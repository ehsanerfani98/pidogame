// setInterval(() => {
//     plusSlides(1);
// }, 5000);

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    captionText.innerHTML = dots[slideIndex - 1].alt;
}

function getslug(item) {
    var buttons = $('.switch_' + $(item).data('slug'));
    for (let i = 0; i < buttons.length; i++) {
        const button = buttons.eq(i);
        if ($(button).is(':checked')) {
            var region = $(button).data('region');
            var slug = $(button).data('slug');
            var region_card = region + '_' + slug;
            var collection = $('.game_' + slug);
            for (let i = 0; i < collection.length; i++) {
                const element = collection.eq(i);
                var attr = element.attr('data-region-slug');
                if (attr !== undefined && region_card !== undefined && attr !== '' && region_card !== '') {
                    if (attr == region_card) {
                        element.removeClass('d-none').addClass('d-block');
                    }
                }
            }
        } else {
            var region = $(button).data('region');
            var slug = $(button).data('slug');
            var region_card = region + '_' + slug;
            var collection = $('.game_' + slug);
            for (let i = 0; i < collection.length; i++) {
                const element = collection.eq(i);
                var attr = element.attr('data-region-slug');
                if (attr !== undefined && region_card !== undefined && attr !== '' && region_card !== '') {
                    if (attr == region_card) {
                        element.removeClass('d-block').addClass('d-none');
                    }
                }
            }
        }
    }

    var check = [];
    for (let i = 0; i < buttons.length; i++) {
        const button = buttons.eq(i);
        if (!$(button).is(':checked')) {
            check.push('1')
        }
    }

    if (check.length == buttons.length) {
        var collection = $('.game_' + slug);
        for (let i = 0; i < collection.length; i++) {
            const element = collection.eq(i);
            element.removeClass('d-none').addClass('d-block');
        }
    }
}


  