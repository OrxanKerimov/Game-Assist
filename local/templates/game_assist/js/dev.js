function exit()
{
    throw new Error();
}

$( document ).ready(function() {



    $(document).ready(function () { //FORM-FEEDBACK

        function reset() {
            $('input').val('');
        };

        $('.feedback-ajax').submit(function () {
            var that = $(this);
            var data = that.serialize();

            $.ajax({
                type: 'post',
                url: '/ajax/feedback/feedback-form.php',
                data: data,
                dataType: 'html',
                success: function (response) {

                    if (response == 1) location.reload();
                    else
                    {
                        $('.alert-warning').css('display', 'block')
                        $('.errortext').text(response)
                    }


                    reset()
                },
                error: function (e) {
                    //console.log(false);
                }
            });
            return false;

        });


    })

    $(document).ready(function () { //SIGN UP

        function reset() {
            $('input').val('');
        };

        $('.registration-form').submit(function () {
            var that = $(this);
            var data = that.serialize();

            $.ajax({
                type: 'post',
                url: '/ajax/signs/signup.php',
                data: data,
                dataType: 'html',

                success: function (response) {
                    if (response == 'success') location.reload();
                    else
                    {
                        $('.alert-warning').css('display', 'block')
                        $('.errortext').text(response)
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
            return false;

        });

    })

    $(document).ready(function () { // CHANGE PERSONAL DATA

        $('.profile-contact-info-ajax').submit(function (e) {
            e.preventDefault();
            var that = $(this);
            var data = that.serialize();
            var that = $(this),
                formData = new FormData(that.get(0));

            $.ajax({
                contentType: false,
                processData: false,
                type: 'POST',
                url: '/ajax/personal/changeData.php',
                data: formData,
                dataType: 'html',

                success: function (response) {
                    if (response == 1) location.reload();
                    else
                    {
                        $('.alert-warning-profile').css('display', 'block')
                        $('.errortext').text(response)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
            return false;

        });

    })

    $(document).ready(function () { // CHANGE PASSWORD IN PROFILE

        $('.change-pass-ajax').submit(function (e) {
            var that = $(this);
            var data = that.serialize();

            $.ajax({
                type: 'POST',
                url: '/ajax/personal/changePass.php',
                data: data,
                dataType: 'html',

                success: function (response) {
                    // console.log(response);
                    if (response == 1) location.reload();
                    else
                    {
                        $('.alert-warning').css('display', 'block')
                        $('.errortext').text(response)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
            return false;

        });


    })

    $(document).ready(function () { // CHANGE PASS FORM

        $('.changepassword-ajax').submit(function (e) {
            var that = $(this);
            var data = that.serialize();

            $.ajax({
                type: 'POST',
                url: '/ajax/forgotPass/changePass.php',
                data: data,
                dataType: 'html',

                success: function (response) {
                    if (response == 1) location.href="/";
                    else
                    {
                        $('.alert-warning').css('display', 'block')
                        $('.errortext').text(response)
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
            return false;

        });

    })

    $(document).ready(function () { // FORGOT PASS

        $('.forgot-pass-ajax').submit(function (e) {
            var lang = $('.authorization-title').attr('data-lang')
            var that = $(this);
            var data = that.serialize();

            $.ajax({
                type: 'POST',
                url: '/ajax/forgotPass/forgotPass.php',
                data: data,
                dataType: 'html',

                success: function (response) {
                    if(lang == 'en')
                    {
                        if(response == 2)
                        {
                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text('Account with this mail does not exist.')
                        }
                        else if(response == 3)
                        {
                            $('.alert-warning').css('display', 'none')
                            $('.alert-success').css('display', 'block')
                            $('.successtext').text('A recovery link has been sent to the filled email address. Check the spam folder or wait for the email' +
                                ', each request generates a new unique code.')
                        }
                    }
                    else
                    {
                        if(response == 2)
                        {
                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text('Аккаунта с данной почтой не существует.')
                        }
                        else if(response == 3)
                        {
                            $('.alert-warning').css('display', 'none')
                            $('.alert-success').css('display', 'block')
                            $('.successtext').text('На указанную почту отправлена ссылка для восстановления. Проверьте папку спам или дождитесь письма' +
                                ', каждый запрос генерирует новый уникальный код.')
                        }
                    }



                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
            return false;

        });

    })

    $(document).ready(function () { //FORM-FEEDBACK-RATE

        function reset() {
            $('input').val('');
        };

        $('.form-rate-ajax').submit(function () {
            var that = $(this);
            var data = that.serialize()
            var url = location.protocol + '//' + location.host + location.pathname;
            var lang = $('.authorization-title').attr('data-lang')

            $.ajax({
                type: 'post',
                url: '/ajax/feedback/otzivy.php',
                data: data,
                dataType: 'html',
                success: function (response) {

                    if(lang == 'en')
                    {
                        if(response == 1)
                        {
                            $('.alert-warning').css('display', 'none')
                            $('.alert-success').css('display', 'block')
                            $('.successtext').text('Thanks for review!')
                            setTimeout(function () {
                                $('.alert-success').css('display', 'none')
                            }, 3000);
                        }
                        else
                        {
                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text(response)
                        }


                    }
                    else
                    {
                        if(response == 1)
                        {
                            $('.alert-warning').css('display', 'none')
                            $('.alert-success').css('display', 'block')
                            $('.successtext').text('Спасибо за отзыв!')
                            setTimeout(function () {
                                $('.alert-success').css('display', 'none')
                            }, 3000);
                        }
                        else
                        {
                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text(response)
                        }
                    }

                    // reset()
                },
                error: function (error) {
                    console.log(error);
                }
            });
            return false;

        });


    })
    // function getSelectedAll(count)
    // {
    //     for (var i = 0; i < count; i++)   //Поиск выбора сразу всех чекбоксов
    //     {
    //         if($('.usluga-'+i+'.active').val() !== undefined )
    //         {
    //             var all = /все задачи/i.test($('.checkbx-'+i).text());
    //             var number = $('.usluga-'+i).val().replace(/[^0-9]/g,"");
    //             var allPrice = number;
    //         }
    //
    //     }
    //     return allPrice;
    // }
    $( document ).on('click', '.review-modal-up', function()
    {
        $('.popup-review-'+$(this).attr('data-modal')).css('display', 'block')
    })

    $( document ).on('click', '.close-response', function()
    {
        $('.popup-review-'+$(this).attr('data-close')).css('display', 'none')
    })

    $(document).on('change', '.input-scroll', function () {
        var multiplie = $('.multiple-scroll').val()
        if(!multiplie || multiplie <= 0) multiplie = 1;
        var value = this.value;

        $(this).val(value * Number(multiplie))
        $('.details-form__range-input').val(value)

        changePriceParams()
    })

    $('.details-form__range-input').change(function () {
        var multiplie = $('.multiple-scroll').val()
        if(!multiplie || multiplie <= 0) multiplie = 1;
        var value = this.value;
        var final = value * Number(multiplie)

        $('.input-scroll').val(final)
        $('.input-scroll-blank').val(final.toLocaleString())

        changePriceParams()
    });



    function discounts(basePriceNonChange, basePrice, multiplieScroll) //Подсчёт скидок и установка новой базовой цены с учётом скидок
    {
        var multiplie = $('.multiple-scroll').val()

        if(!multiplie || multiplie <= 0) multiplie = 1;

        var scroll = multiplieScroll / multiplie

        var countDiscount = $('.do-ajax').attr('data-discount'); // Получаем колиство скидок

        if(scroll >= 1)  //Установка базовой цены
        {
            if(basePrice == 0) basePrice = (basePrice+1) * scroll
            else basePrice = basePrice * scroll
        }

        if(countDiscount && countDiscount.length >= 1)
        {

            for (var i = 0; i < countDiscount; i++ ) //Подсчёт скидок
            {
                var discountMinMaterial; var discountMinBase; var currentItem; var discount;
                discountMinMaterial = $('.discount-'+i).attr('min-material');
                discountMinBase = $('.discount-'+i).attr('min-base');
                currentItem = $('.discount-'+i).text();
                var procent = /\%/.test(currentItem);
                discount = Number( $('.discount-'+i).text().replace(/[^0-9]/g,"") );
                var currentDiscount = 0;
                if (Number(multiplieScroll) >= Number(discountMinMaterial) && Number(basePriceNonChange) >= Number(discountMinBase) && countDiscount >= 2)
                {
                    currentDiscount++;
                }

                $('.discount-val-'+i).val('');
                $('.discount-check-'+i).prop('checked', false);
            }
            console.log(currentDiscount)
            console.log(countDiscount)
            if(countDiscount == 1) currentDiscount = 0
            for (var i = 0; i < countDiscount; i++ ) //Подсчёт скидок
            {

                var discountMinMaterial; var discountMinBase; var currentItem; var discount;
                discountMinMaterial = $('.discount-'+i).attr('min-material');
                discountMinBase = $('.discount-'+i).attr('min-base');
                currentItem = $('.discount-'+i).text();
                var procent = /\%/.test(currentItem);
                discount = Number( $('.discount-'+i).text().replace(/[^0-9]/g,"") );
                if (Number(multiplieScroll) >= Number(discountMinMaterial) && Number(basePriceNonChange) >= Number(discountMinBase))
                {
                    if(i == currentDiscount)
                    {
                        if(procent == true) basePrice = Math.round(basePrice - (basePrice * discount / 100));
                        else if(procent == false) basePrice = basePrice - discount;
                        $('.discount-val-'+i).val(currentItem);
                        console.log('success');
                        $('.discount-check-'+i).prop('checked', true);
                    }

                }
                else {
                    console.log("FULL OUT")
                    $('.discount-val-'+i).val('');
                    $('.discount-check-'+i).prop('checked', false);
                }
            }

        }

        return basePrice;
    }
    function cleanArray(actual) {
        var newArray = new Array();
        for (var i = 0; i < actual.length; i++) {
            if (actual[i] != null && actual[i] != '') {
                newArray.push(actual[i]);
            }
        }
        return newArray;
    }

    function getAllCheckbox()
    {
        var lbzParentCount = $('.lbz-parent-count').val();
        var lbzCount = $('.lbz-count').val();
        var lbzArAll = [];

        for ( var i = 0; i < lbzParentCount; i++ ) //Получаем общее количество чекбоксов
        {
            let innerArr = [];
            for ( var j = 0; j < lbzCount; j++ )
            {
                if(!$('.lbz-'+i+'-'+j).val()) {continue;}
                else  innerArr[j] = 1;
            }
            lbzArAll[i] = innerArr;
        }

        return lbzArAll;
    }

    function getActiveCheckbox()
    {
        var lbzParentCount = $('.lbz-parent-count').val();
        var lbzArAll = getAllCheckbox();
        var lbzAr = [];

        for ( var i = 0; i < lbzParentCount; i++ ) //Получаем активные чекбоксы
        {
            let innerArr = [];
            for ( var j = 0; j < lbzArAll[i].length; j++ )
            {
                if(!$('.lbz-'+i+'-'+j+'.active').val()) {continue;}
                else innerArr[j] = 1;
            }
            var newArray = cleanArray(innerArr) //Удаление пустых элементов
            if(newArray != undefined || newArray.length > 0) lbzAr[i] = newArray;
        }

        return lbzAr;
    }
    $( document ).on('click', '.all-tasks-js', function () {

        var countLbzParent = getAllCheckbox()
        var countLbz = getActiveCheckbox()
        var activeElementsAr = [];
        var n = 3;
        var firstID = $(this).attr('first-id')

        // for ( var i = 0; i < countLbzParent[firstID].length; i++ )
        // {
        //     $('.lbz-price-' + firstID + '-' + i).prop('checked', true)
        //     $('.lbz-price-' + firstID + '-' + i).addClass('active')
            // $('.all-tasks-input-'+firstID).prop('checked', true)
            // $('.all-tasks-input-'+firstID).addClass('active')
        // }

        if(!this.classList.contains('active'))
        {
            // console.log($('.all-tasks-js-'+firstID+'.active').val())
            for ( var i = 0; i < countLbzParent[firstID].length; i++ )
            {
                    $('.lbz-price-' + firstID + '-' + i).prop('checked', false)
                    $('.lbz-price-' + firstID + '-' + i).removeClass('active')
            }
            $('.discount-val-'+firstID).val('');
            $('.discount-check-'+firstID).prop('checked', false);
        }
        else
        {
            for ( var i = 0; i < countLbzParent[firstID].length; i++ )
            {
                $('.lbz-price-' + firstID + '-' + i).prop('checked', true)
                $('.lbz-price-' + firstID + '-' + i).addClass('active')
            }
        }
    })

    function lbzParams (count, basePrice)
    {
        var countLbz = $('.do-ajax').attr('count-lbz')
        var countLbzParent = $('.do-ajax').attr('count-parent')
        var price = 0;
        discountSum = 0;
        var items = [];
        var n = 0;
        var currentCountLbz = 0;

        for (var i = 0; i < countLbzParent; i++)
        {

            for (var j = 0; j < countLbz; j++)
            {

                if($('.lbz-all-'+i+'.active').val() && j == countLbz-1) //Проверяем нажата ли кнопка все задачи
                {
                    price += Number($('.lbz-all-'+i).val());

                    // for ( var l = 0; l < countLbz; l++ )
                    // {
                        // currentItem = $('.lbz-price-' + i + '-' + l).val();
                        // $('.lbz-' + i + '-' + l);
                        // $('.lbz-price-' + i + '-' + l).val(currentItem);
                    // }
                }
                else
                {
                    if ($('.lbz-'+i+'-'+j+'.active').val() != undefined)   //Поиск активных чекбоксов
                    {
                        if($('.lbz-all-'+i+'.active').val()) continue //Проверяем нажата ли кнопка все задачи
                        price += Number($('.lbz-'+i+'-'+j).val());

                    }
                }
            }
            if($('.lbz-ungreat-'+i+'.active').val())
            {
                price += Number($('.lbz-ungreat-'+i+'.active').val());
            }
            if($('.lbz-great-'+i+'.active').val())
            {
                price += Number($('.lbz-great-'+i+'.active').val());
            }

        }
        if (/lbz/.test(location.pathname) == true)
        {
            var lbzParentCount = $('.lbz-parent-count').val();
            var lbzCount = $('.lbz-count').val();
            var lbzCountExactly = 0;

            var lbzArAll = getAllCheckbox()
            var lbzAr = getActiveCheckbox()

            for ( var i = 0; i < lbzParentCount; i++ ) //Получаем сумму скидок
            {
                discount = Number( $('.discount-'+i).text().replace(/[^0-9]/g,"") );
                if(lbzArAll[i].length == lbzAr[i].length || $('.lbz-all-'+i+'.active').val())
                {
                    discountSum += discount
                }
            }

            for ( var i = 0; i < lbzParentCount; i++ ) //Получаем активные чекбоксы
            {
                var currentItem; var discount;
                currentItem = $('.discount-'+i).text();
                var procent = /\%/.test(currentItem);
                discount = Number( $('.discount-'+i).text().replace(/[^0-9]/g,"") );

                if(lbzArAll[i].length == lbzAr[i].length || $('.lbz-all-'+i+'.active').val())
                {
                    $('.discount-val-'+i).val(currentItem);
                    $('.discount-check-'+i).prop('checked', true);

                }
                else
                {
                    $('.discount-val-'+i).val('');
                    $('.discount-check-'+i).prop('checked', false);

                    // $('.lbz-all-'+i).prop('checked', false);
                    // $('.lbz-all-'+i).removeClass('active');
                }

            }

            if(procent == true) price = Math.round(price - (price * discountSum / 100) );
            else if(procent == false) price = price - discount;
            console.log(price)
        }



        return price;
    }


    function changePriceParams()
    {
        var count = $('.do-ajax').attr('data-count'); // Получаем колиство чекбоксов
        var scroll = $('.input-scroll').val(); //Получаем количество со скролла
        var basePrice = $('.do-ajax').attr('data-base');
        const basePriceNonChange = $('.do-ajax').attr('data-base');
        // var uslugaNameBase = $('.select-text').text();
        // var uslugaMisstakes = /RURU/.test(uslugaNameBase);
        //
        //
        // if(uslugaMisstakes == true)
        // {
        //     var uslugaName = uslugaNameBase.replace(/RURU/, "");
        //     $('.base-name-input').val(uslugaName);
        // }
        basePrice = discounts(basePriceNonChange, basePrice, scroll) //Подсчёт скидок и установка новой базовой цены с учётом скидок
        var lbzModal = Number(lbzParams(count, basePrice))

        var items = [];
        var n = 0;

        for (var i = 0; i < count; i++)
        {
            if($('.usluga-'+i+'.active').val() !== undefined )   //Поиск активных чекбоксов
            {
                items[n] = $('.usluga-'+i+'.active').val();
                n++;
            }
        }

                if(items.length == 0)   //Установка базовой цены при отсутствиии активных чекбоксов
                {
                    var fullPrice = Number(basePrice)+Number(lbzModal)
                    $('.do-ajax').attr('data-current', fullPrice.toLocaleString())
                    $('.do-ajax').text(fullPrice.toLocaleString())
                    $('.full-price-ajax').val(fullPrice.toLocaleString())
                    // .toLocaleString()
                }
                else
                {
                    for (var i = 0; i < items.length; i++)
                    {

                        currentItem = items[i];

                        if(i == 0)
                        {
                            var fullPrice = Number(basePrice)+Number(lbzModal)
                            $('.do-ajax').attr('data-current', fullPrice);
                            $('.full-price-ajax').val(fullPrice.toLocaleString());
                        }

                        var plus    = /\+/.test(currentItem);
                        var minus   = /\-/.test(currentItem);
                        var procent = /\%/.test(currentItem);
                        var number  = currentItem.replace(/[^0-9]/g,""); //Получаем цифру без символов

                        var currentPrice = $('.do-ajax').attr('data-current')
                        if(procent == true) //Далее идёт расчёт цены с процентом
                        {
                            if(plus == true)
                            {
                                var final = ($('.do-ajax').attr('data-current') / 100 * number + Number($('.do-ajax').attr('data-current')));
                                var roundPrice = Math.round(final)
                                $('.do-ajax').text(roundPrice.toLocaleString());
                                $('.do-ajax').attr('data-current', roundPrice);
                            }
                            else if(minus == true)
                            {
                                var final = (Number($('.do-ajax').attr('data-current')) - $('.do-ajax').attr('data-current') / 100 * number);
                                var roundPrice = Math.round(final)
                                $('.do-ajax').text(roundPrice.toLocaleString());
                                $('.do-ajax').attr('data-current', roundPrice);
                            }
                        }
                        else //Далее идёт расчёт цены без процента
                        {
                            if(plus == true)
                            {
                                var final = (Number($('.do-ajax').attr('data-current')) + Number(number));
                                var roundPrice = Math.round(final)
                                $('.do-ajax').text(roundPrice.toLocaleString());
                                $('.do-ajax').attr('data-current', roundPrice);
                            }
                            else if(minus == true)
                            {
                                var final = (Number($('.do-ajax').attr('data-current')) - Number(number));
                                var roundPrice = Math.round(final)
                                $('.do-ajax').text(roundPrice.toLocaleString());
                                $('.do-ajax').attr('data-current', roundPrice);
                            }
                        }


                    }
                }
            //$('.do-ajax').text(allPrice); //Выводим цену кнопки "Выбрать все"



    }


    $( document ).on('click', '.lbz-price', function () { //Проверка выбраны ли все обычные чекбоксы ЛБЗ
        var id = $(this).attr('first-id')
        var countLbzParent = getAllCheckbox()
        var countLbz = getActiveCheckbox()


        if(countLbzParent[id].length == countLbz[id].length)
        {
            $('.lbz-all-'+id).prop('checked', true);
            $('.lbz-all-'+id).addClass('active');
        }
        else
        {
            $('.lbz-all-'+id).prop('checked', false);
            $('.lbz-all-'+id).removeClass('active');

            $('.discount-val-'+id).val('');
            $('.discount-check-'+id).prop('checked', false);
        }
        changePriceParams()
    })

    $('.lbz').click(function () { //Нажатие на чекбоксы
        $(this).toggleClass('active');
        changePriceParams()
    });

    $('.quick-filter__option').click(function () {
        var id = $(this).attr('data-id')
        $('.do-ajax').attr('data-base', $('.quick-filter__select-price-'+id).val())
        changePriceParams()

    });
    $('.usluga-params-ajax').click(function () {
        $(this).toggleClass('active');
        changePriceParams()
    });

    $('.popup-close').click(function (e) {
        e.preventDefault();
        $('body').removeClass('o-hidden');
        $('.lbz').prop('checked', false);
        $('#popup, #popup-review, #popup-tasks').removeClass('active');
        $('.lbz').removeClass('active');
    });
    $('.popup-tasks__btn').click(function (e) {
        $('body').removeClass('o-hidden');
        $('#popup, #popup-review, #popup-tasks').removeClass('active');
    });

    $(document).ready(function () { // REDIRECT TO MAKING AN ORDER

        $('.detail-usluga-ajax').submit(function () {
            var that = $(this);
            var data = $('.detail-usluga-ajax').serialize();


            $.ajax({
                type: 'POST',
                url: '/ajax/uslugi/makeOrder.php',
                data: data,
                dataType: 'html',

                success: function (response) {
                    // console.log(response)
                    if (response == 'error')
                    {
                        $('body,html').animate({scrollTop: 0}, 400);
                        if($('.lang-ajax').val() == 'RU')
                        {
                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text('Для оформления заказа выберите хотя-бы одну услугу.')
                            setTimeout(function () {
                                $('.alert-warning').css('display', 'none')
                            }, 3000);
                        }
                        else
                        {

                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text('To place an order, select at least one service.')
                            setTimeout(function () {
                                $('.alert-warning').css('display', 'none')
                            }, 3000);
                        }


                    }
                    else location.href = response;

                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
            return false;

        });

    })


    var timeOut;
    $(document).ready(function () { //ORDER

        function reset() {
            $('input').val('');
        };

        $('.quick-form-ajax').submit(function () {
            var that = $(this);
            var data = that.serialize();
            var get = location.search

            // clearTimeout(timeOut);
            // timeOut = setTimeout(function() {
                $.ajax({
                    type: 'post',
                    url: '/ajax/feedback/order.php' + get,
                    data: data,
                    dataType: 'html',
                    success: function (response) {
                        // console.log(response)
                        if (response == 1)
                        {
                            if($('.lang-ajax').val() == 'RU') location.href = '/uslugi/';
                            else location.href = '/en/uslugi/';
                        }
                        else {
                            $('.alert-warning').css('display', 'block')
                            $('.errortext').text(response)

                        }
                        // reset()
                    },
                    error: function (e) {
                        //console.log(false);
                    }
                });
                return false;
            // }, 1000)

        });


    })

    // $('.review-modal-up').click(function (e) {
    //   e.preventDefault();
    //   $('body').addClass('o-hidden');
    //   $('#popup-review').addClass('active');
    // });


})





















