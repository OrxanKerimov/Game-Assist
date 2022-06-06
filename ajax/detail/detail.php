<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
CModule::IncludeModule('iblock');

$service_detail = CIBlockElement::GetList(
    array(),
    array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'SECTION_CODE' => $_GET['id'], 'ACTIVE' => 'Y'),
    false,
    array(),
    array('ID', 'CODE', 'PROPERTY_DISCOUNT_NAME', 'PROPERTY_DISCOUNT_PRICE', 'PROPERTY_SERVICE_INCLUDES', 'PROPERTY_SCROLL_NAME', 'PROPERTY_SCROLL_NAME_EN', 'PROPERTY_SCROLL_MAX', 'PROPERTY_SCROLL_MIN', 'PROPERTY_LIST_NAME', 'PROPERTY_LIST_PRICE', 'PROPERTY_CHECK_NAME', 'PROPERTY_CHECK_PRICE', 'PROPERTY_TANK_LIST', 'PROPERTY_NAME1_TANK', 'PROPERTY_PRICE1_TANK', 'PROPERTY_PRICE3_TANK', 'PROPERTY_PRICE4_TANK', 'PROPERTY_PRICE5_TANK', 'PROPERTY_PRICE2_TANK', 'PROPERTY_NAME2_TANK', 'PROPERTY_NAME3_TANK', 'PROPERTY_NAME4_TANK', 'PROPERTY_NAME5_TANK'));

$service_additional =$service_detail->GetNext();

if($service_additional['PROPERTY_NAME1_TANK_VALUE']):
    $number = $_POST['number'];
    $tank_name = array($service_additional['PROPERTY_NAME1_TANK_VALUE'],$service_additional['PROPERTY_NAME2_TANK_VALUE'],$service_additional['PROPERTY_NAME3_TANK_VALUE'],$service_additional['PROPERTY_NAME4_TANK_VALUE'],$service_additional['PROPERTY_NAME5_TANK_VALUE']);
    $tank_price = array($service_additional['PROPERTY_PRICE1_TANK_VALUE'],$service_additional['PROPERTY_PRICE2_TANK_VALUE'],$service_additional['PROPERTY_PRICE3_TANK_VALUE'],$service_additional['PROPERTY_PRICE4_TANK_VALUE'],$service_additional['PROPERTY_PRICE5_TANK_VALUE']);
    for($i = 0; $i < count($service_additional['PROPERTY_NAME1_TANK_VALUE']);$i++):?>
        <div class="details-form__group">
            <label class="label-checkbox">
                <input name="usluga" value="" type="hidden">
                <input name="USLUGI[USLUGA-<?=$i?>][VALUE]" value="<?=$tank_price[$number][$i]?>" type="checkbox" data-id="<?=$i?>" class="visually-hidden usluga-params-ajax usluga-<?=$i?>">
                <input name="USLUGI[USLUGA-<?=$i?>][NAME]" value="<?=$tank_name[$number][$i]?>" type="hidden" data-id="<?=$i?>">

                <span></span>
                <div class="checkbox-text">
                    <div class="ckeckbox-title checkbx-<?=$i?>"><p><?=$tank_name[$number][$i]?></p></div>
                    <div class="ckeckbox-description"><span><?=$tank_price[$number][$i]?></span> ₽</div>
                </div>
            </label>
        </div>
    <?endfor;
    endif;?>
<div class="details-form__price details-form__total">
    Итого:

    <div class="details-form__price-value details-form__total-value"><span  data-base="0" data-current="0"
    <?php if(count($service_additional['PROPERTY_CHECK_NAME_VALUE']) > count($service_additional['PROPERTY_NAME1_TANK_VALUE'])):?>
        data-count="<?=count($service_additional['PROPERTY_CHECK_NAME_VALUE'])?>"
    <?php else:?>
        data-count="<?=count($service_additional['PROPERTY_NAME1_TANK_VALUE'])?>"
    <?php endif;?>
    class="do-ajax">0</span> ₽</div>
</div>
<script>
    $(document).on('change', '.input-scroll', function () {
        $('.details-form__range-input').val($(this).val())
        changePriceParams()
    })
    $('.details-form__range-input').change(function () {
        let value = this.value;
        $('.input-scroll').val(value)
        changePriceParams()
    });

    function discounts(basePriceNonChange, basePrice, scroll) //Подсчёт скидок и установка новой базовой цены с учётом скидок
    {
        var countDiscount = $('.do-ajax').attr('data-discount'); // Получаем колиство скидок

        if(scroll >= 1)  //Установка базовой цены
        {
            if(basePrice == 0) basePrice = (basePrice+1) * scroll
            else basePrice = basePrice * scroll
        }

        if(countDiscount && countDiscount.length >= 1)
        {
            for (let i = 0; i < countDiscount; i++ ) //Подсчёт скидок
            {
                var discountMinMaterial; var discountMinBase; var currentItem; var discount;
                discountMinMaterial = $('.discount-'+i).attr('min-material');
                discountMinBase = $('.discount-'+i).attr('min-base');
                currentItem = $('.discount-'+i).text();
                var procent = /\%/.test(currentItem);
                discount = Number( $('.discount-'+i).text().replace(/[^0-9]/g,"") );

                if (Number(scroll) > Number(discountMinMaterial) && Number(basePriceNonChange) >= Number(discountMinBase))
                {
                    if(procent == true) basePrice = Math.round(basePrice - basePrice / 100 * discount);
                    else if(procent == false) basePrice = basePrice - discount;
                    $('.discount-val-'+i).val(currentItem);
                    console.log('success');
                }
                else {
                    console.log("FULL OUT")
                    $('.discount-val-'+i).val('');
                }
            }
        }

        return basePrice;
    }


    function lbzParams (count, basePrice)
    {

        var countLbz = $('.do-ajax').attr('count-lbz')
        var countLbzParent = $('.do-ajax').attr('count-parent')
        var price = 0;
        var items = [];
        var n = 0;

        for (let i = 0; i < countLbzParent; i++)
        {
            if($('.lbz-all-'+i+'.active').val())
            {
                // items[n] = $('.lbz-all-'+i+'.active').val();
                price += Number($('.lbz-all-'+i+'.active').val());
                continue;
            }
            else
            {
                for (let j = 0; j < countLbz; j++)
                {
                    if($('.lbz-'+i+'-'+j+'.active').val() !== undefined )   //Поиск активных чекбоксов
                    {
                        // items[n] = $('.lbz-'+i+'-'+j+'.active').val();
                        price += Number($('.lbz-'+i+'-'+j+'.active').val());
                    }
                }
            }

        }

        // if(items.length == 0)   //Установка базовой цены при отсутствиии активных чекбоксов
        // {
        //     $('.do-ajax').attr('data-current', Number(basePrice)+Number(lbzModal))
        //     $('.do-ajax').text(Number(basePrice)+Number(lbzModal))
        //     $('.full-price-ajax').val(Number(basePrice)+Number(lbzModal))
        //
        // }
        console.log(price)

        return price;
    }

    function changePriceParams()
    {
        var count = $('.do-ajax').attr('data-count'); // Получаем колиство чекбоксов
        var scroll = $('.input-scroll').val(); //Получаем количество со скролла
        var basePrice = $('.do-ajax').attr('data-base');
        const basePriceNonChange = $('.do-ajax').attr('data-base');
        var uslugaNameBase = $('.select-text').text();
        var uslugaMisstakes = /RURU/.test(uslugaNameBase);


        if(uslugaMisstakes == true)
        {
            var uslugaName = uslugaNameBase.replace(/RURU/, "");
            $('.base-name-input').val(uslugaName);
        }
        basePrice = discounts(basePriceNonChange, basePrice, scroll) //Подсчёт скидок и установка новой базовой цены с учётом скидок
        var lbzModal = Number(lbzParams(count, basePrice))

        var items = [];
        var n = 0;

        for (let i = 0; i < count; i++)
        {
            if($('.usluga-'+i+'.active').val() !== undefined )   //Поиск активных чекбоксов
            {
                items[n] = $('.usluga-'+i+'.active').val();
                n++;
            }
        }

        if(items.length == 0)   //Установка базовой цены при отсутствиии активных чекбоксов
        {
            $('.do-ajax').attr('data-current', Number(basePrice)+Number(lbzModal))
            $('.do-ajax').text(Number(basePrice)+Number(lbzModal))
            $('.full-price-ajax').val(Number(basePrice)+Number(lbzModal))

        }
        else
        {
            for (let i = 0; i < items.length; i++)
            {
                currentItem = items[i];

                if(i == 0)
                {
                    $('.do-ajax').attr('data-current', Number(basePrice)+Number(lbzModal));
                    $('.full-price-ajax').val(Number(basePrice)+Number(lbzModal));
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
                        $('.do-ajax').text(Math.round(final));
                        $('.do-ajax').attr('data-current', Math.round(final));
                        $('.full-price-ajax').val(Math.round(final));
                    }
                    else if(minus == true)
                    {
                        var final = (Number($('.do-ajax').attr('data-current')) - $('.do-ajax').attr('data-current') / 100 * number);
                        $('.do-ajax').text(Math.round(final));
                        $('.do-ajax').attr('data-current', Math.round(final));
                        $('.full-price-ajax').val(Math.round(final));
                    }
                }
                else //Далее идёт расчёт цены без процента
                {
                    if(plus == true)
                    {
                        var final = (Number($('.do-ajax').attr('data-current')) + Number(number));
                        $('.do-ajax').text(Math.round(final));
                        $('.do-ajax').attr('data-current', Math.round(final));
                        $('.full-price-ajax').val(Math.round(final));
                    }
                    else if(minus == true)
                    {
                        var final = (Number($('.do-ajax').attr('data-current')) - Number(number));
                        $('.do-ajax').text(Math.round(final));
                        $('.do-ajax').attr('data-current', Math.round(final));
                        $('.full-price-ajax').val(Math.round(final));
                    }
                }


            }
        }
        //$('.do-ajax').text(allPrice); //Выводим цену кнопки "Выбрать все"



    }

    $('.quick-filter__option').click(function () {
        var id = $(this).attr('data-id')
        $('.do-ajax').attr('data-base', $('.quick-filter__select-price-'+id).val())
        changePriceParams()

    });
    $('.usluga-params-ajax').click(function () {
        $(this).toggleClass('active');
        changePriceParams()
    });
</script>