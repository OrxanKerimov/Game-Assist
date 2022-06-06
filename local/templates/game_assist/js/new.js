

$( document ).ready(function() { // ОСТАВИТЬ ОТЗЫВ "ВЫВОД УСЛУГ"
    var selections = document.querySelectorAll('.quick-filter__option')
    var inputUsluqi = document.querySelector('#filter__select_id')

    for (let prop in selections) {
        if (selections[prop].addEventListener) {
            selections[prop].addEventListener("click", function () {
                inputUsluqi.value = selections[prop].dataset.filter
            })
        }
    }
})

$( document ).ready(function() { // ОСТАВИТЬ ОТЗЫВ "РЕЙТИНГ"
    var rating = document.querySelector('.block-rating__content'),
        ratingItem = document.querySelectorAll('.block-rating__item');


    var rateInout = document.querySelector('#rate_hidden_input')

    rating.onclick = function (e) {
        var target = e.target;
        if (target.classList.contains('block-rating__item')) {
            removeClass(ratingItem, 'current-active')
            target.classList.add('active', 'current-active');
            rateInout.value = target.dataset.rate
        }
    }

    rating.onmouseover = function (e) {
        var target = e.target;
        if (target.classList.contains('block-rating__item')) {
            removeClass(ratingItem, 'active')
            target.classList.add('active');
            mouseOverActiveClass(ratingItem)
        }
    }
    rating.onmouseout = function () {
        addClass(ratingItem, 'active');
        mouseOutActiveClas(ratingItem);
    }

    function removeClass(arr) {
        for (var i = 0, iLen = arr.length; i < iLen; i++) {
            for (var j = 1; j < arguments.length; j++) {
                ratingItem[i].classList.remove(arguments[j]);
            }
        }
    }

    function addClass(arr) {
        for (var i = 0, iLen = arr.length; i < iLen; i++) {
            for (var j = 1; j < arguments.length; j++) {
                ratingItem[i].classList.add(arguments[j]);
            }
        }
    }

    function mouseOverActiveClass(arr) {
        for (var i = 0, iLen = arr.length; i < iLen; i++) {
            if (arr[i].classList.contains('active')) {
                break;
            } else {
                arr[i].classList.add('active');
            }
        }
    }

    function mouseOutActiveClas(arr) {
        for (var i = arr.length - 1; i >= 1; i--) {
            if (arr[i].classList.contains('current-active')) {
                break;
            } else {
                arr[i].classList.remove('active');
            }
        }
    }
})

$( document ).ready(function() { // HEADER "СМЕНА ЯЗЫКА"
    console.log(location.search);
    $('.header-language__item').click(function () {
        let get = window.location.search;
        var value = $(this).attr('data-language');
        let path = window.location.pathname.replace("/en/", "/").replace("/en", "/")
        if (value === "RU") {
            window.location = path + get
        } else {
            window.location = `/${value.toLowerCase()}${path}`+get
        }
    });
})

$( document ).ready(function() { // HEADER "ЗАКРЫТИЕ МЕНЮ"

    jQuery(function($){
        $(document).mouseup( function(e){
            var select_lang = $( "#select_lang" );
            var select_profile = $( "#select_profile" );
            var profile = $( "#profile" );
            var lang = $( "#lang" );
            if ( !select_profile.is(e.target) && !profile.is(e.target)
                && profile.has(e.target).length === 0 && select_profile.has(e.target).length === 0 ) {
                select_profile.hide();
            }
            if ( !select_lang.is(e.target) && !lang.is(e.target)
                && lang.has(e.target).length === 0 && select_lang.has(e.target).length === 0 ) {
                select_lang.hide();
            }
        });
    });

})

