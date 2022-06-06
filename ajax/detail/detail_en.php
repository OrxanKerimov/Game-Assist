<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
CModule::IncludeModule('iblock');

$service_detail = CIBlockElement::GetList(
 array(),
array('INCLUDE_SUBSECTIONS' => 'Y', 'IBLOCK_ID' => 12, 'SECTION_CODE' => $_GET['id'], 'ACTIVE' => 'Y'),
false,
array(),
 array('ID','CODE', 'NAME', 'PROPERTY_DISCOUNT_NAME_EN','PROPERTY_DISCOUNT_PRICE', 'PROPERTY_SCROLL_IN_ONE','PROPERTY_SERVICE_INCLUDES_EN', 'PROPERTY_SCROLL_NAME', 'PROPERTY_SCROLL_NAME_EN','PROPERTY_SCROLL_MAX','PROPERTY_SCROLL_MIN','PROPERTY_LIST_NAME_EN','PROPERTY_LIST_PRICE','PROPERTY_CHECK_NAME_EN','PROPERTY_CHECK_PRICE','PROPERTY_TANK_LIST_EN','PROPERTY_NAME1_TANK_EN','PROPERTY_PRICE1_TANK','PROPERTY_PRICE3_TANK','PROPERTY_PRICE4_TANK','PROPERTY_PRICE5_TANK','PROPERTY_PRICE2_TANK','PROPERTY_NAME2_TANK_EN','PROPERTY_NAME3_TANK_EN','PROPERTY_NAME4_TANK_EN','PROPERTY_NAME5_TANK_EN', 'PROPERTY_MIN_MATERIAL_COUNT', 'PROPERTY_MIN_BASEPRICE_COUNT'));

$service_additional =$service_detail->GetNext();

if($service_additional['PROPERTY_NAME1_TANK_EN_VALUE']):
    $number = $_POST['number'];
    $tank_name = array($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME2_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME3_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME4_TANK_EN_VALUE'],$service_additional['PROPERTY_NAME5_TANK_EN_VALUE']);
    $tank_price = array($service_additional['PROPERTY_PRICE1_TANK_VALUE'],$service_additional['PROPERTY_PRICE2_TANK_VALUE'],$service_additional['PROPERTY_PRICE3_TANK_VALUE'],$service_additional['PROPERTY_PRICE4_TANK_VALUE'],$service_additional['PROPERTY_PRICE5_TANK_VALUE']);
    for($i = 0; $i < count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE']);$i++):?>
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
    <?php if(count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE']) > count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])):?>
        data-count="<?=count($service_additional['PROPERTY_CHECK_NAME_EN_VALUE'])?>"
    <?php else:?>
        data-count="<?=count($service_additional['PROPERTY_NAME1_TANK_EN_VALUE'])?>"
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

    function changePriceParams()
    {
        var count = $('.do-ajax').attr('data-count'); // Получаем колиство чекбоксов
        var countDiscount = $('.do-ajax').attr('data-discount'); // Получаем колиство скидок
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


        var discountMinMaterial; var discountMinBase; var currentItem; var discount;

        if(scroll >= 1)  //Установка базовой цены
        {
            if(basePrice == 0) basePrice = (basePrice+1) * scroll
            else basePrice = basePrice * scroll
        }

        if(countDiscount && countDiscount.length >= 1)
        {
            for (let i = 0; i < countDiscount; i++ ) //Подсчёт скидок
            {
                discountMinMaterial = $('.discount-'+i).attr('min-material')
                discountMinBase = $('.discount-'+i).attr('min-base')
                currentItem = $('.discount-'+i).text();
                var procent = /\%/.test(currentItem);
                discount = Number( $('.discount-'+i).text().replace(/[^0-9]/g,"") );

                if (Number(scroll) > Number(discountMinMaterial) && Number(basePriceNonChange) >= Number(discountMinBase))
                {
                    if(procent == true) basePrice = Math.round(basePrice - basePrice / 100 * discount);
                    else if(procent == false) basePrice = basePrice - discount;
                    $('.discount-val-'+i).val(currentItem)
                    console.log('success')
                }
                else {
                    console.log("FULL OUT")
                    $('.discount-val-'+i).val('')
                }
            }
        }


        for (let i = 0; i < count; i++)   //Поиск выбора сразу всех чекбоксов
        {
            if($('.usluga-'+i+'.active').val() !== undefined )
            {
                var all = /все задачи/i.test($('.checkbx-'+i).text());
                var number = $('.usluga-'+i).val().replace(/[^0-9]/g,"");
                var allPrice = number;
            }

        }
        if(all == false || !all)
        {
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
                $('.do-ajax').attr('data-current', basePrice)
                $('.do-ajax').text(basePrice)
                $('.full-price-ajax').val(basePrice)

            }
            else
            {
                for (let i = 0; i < items.length; i++)
                {
                    currentItem = items[i];

                    if(i == 0)
                    {
                        $('.do-ajax').attr('data-current', basePrice);
                        $('.full-price-ajax').val(basePrice);
                    }

                    var plus    = /\+/.test(currentItem);
                    var minus   = /\-/.test(currentItem);
                    var procent = /\%/.test(currentItem);
                    var number  = currentItem.replace(/[^0-9]/g,""); //Получаем цифру без символов

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
        }
        else
        {
            $('.do-ajax').text(allPrice); //Выводим цену кнопки "Выбрать все"
        }



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