<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
use Bitrix\Main\UserTable;
$USER = new CUser;
$lang = $_POST['LANG'];

$idUser = CUser::GetID();
$rsUser = CUser::GetByID($idUser);
$userAr = $rsUser->Fetch();

$data = [
    'AVATAR'         => $_FILES['AVATAR'],
    'LOGIN'          => filter_var(trim(htmlspecialchars(strip_tags($_POST['LOGIN']))), FILTER_SANITIZE_STRING),
    'EMAIL'          => filter_var(trim(htmlspecialchars(strip_tags($_POST['EMAIL']))), FILTER_SANITIZE_STRING),
    'SKYPE'          => filter_var(trim(htmlspecialchars(strip_tags($_POST['SKYPE']))), FILTER_SANITIZE_STRING),
    'PERSONAL_PHONE' => filter_var(trim(htmlspecialchars(strip_tags($_POST['PHONE_NUMBER']))), FILTER_SANITIZE_STRING),
];



if($lang == 'en')
{
    $langAr = [
        'login' => ['exists' => 'This login is already in use', 'length' => 'Check the length of the "Name" field, it must be at least 5 and no more than 256 characters.'],
        'phone' => 'Check your number, it is at least 9 characters.',
        'skype' => 'The Skype length should not be more than 255 characters.',
        'email' => ['forgot' => 'You forgot to fill your E-mail.', 'exists' => 'An account with such an email already exists.', 'length' => 'Check the length of the "E-mail" field, it must be no more than 255 characters.'],
    ];
}
elseif($lang == 'ru')
{
    $langAr = [
        'login' => ['exists' => 'Логин уже используется', 'length' => 'Проверьте длину поля "Имя", оно должно быть не меньше 5 и не больше 256 символов.'],
        'phone' => 'Проверьте свой номер, он не менее 9 цифр.',
        'skype' => 'Длина скайпа не должна быть более 255 символов.',
        'email' => ['forgot' => 'Вы забыли указать E-mail.', 'exists' => 'Аккаунт с такой почтой уже существует.', 'length' => 'Проверьте длину поля "E-mail", оно должно быть не больше 255 символов.'],
        ];
}


    foreach ($data as $key => $val)
    {
        if($val !== '')
        {
            if($key == 'LOGIN')
            {
                if (strlen($val) >= 5 && strlen($key) < 256)
                {
                    $check = UserTable::getList([
                        'select' => ['ID'],
                        'filter' => ['LOGIN' => $val]
                    ])->fetch();

                    if($check)
                    {
                        if($check['ID'] !== $userAr['ID']) die($langAr['login']['exists']);
                    }
                    else
                    {
                        $result['LOGIN'] = $val;
                    }
                    $result['LOGIN'] = $val;
                }
                else
                {
                    die($langAr['login']['length']);
                }
            }
            elseif($key == 'EMAIL' )
            {
                if(strlen($val) > 5 && strlen($val) < 256)
                {
                    $check = UserTable::getList([
                        'select' => ['ID'],
                        'filter' => ['EMAIL' => $val]
                    ])->fetch();

                    if($check)
                    {
                        if($check['ID'] !== $userAr['ID']) die($langAr['email']['exists']);
                    }
                    else
                    {
                        $result['EMAIL'] = $val;
                    }
                }
                else
                {
                    die($langAr['email']['length']);
                }

            }
            elseif($key == 'PERSONAL_PHONE')
            {
                if(strlen($val) >= 9)
                {
                    $result['PERSONAL_PHONE'] = $val;
                }
                elseif(strlen($val) < 9 && $data[$key])
                {
                   die($langAr['phone']);
                }
            }
            elseif($key == 'SKYPE')
            {
                if(strlen($val) !== 0)
                {
                    if(strlen($val) < 256) $result['UF_SKYPE'] = $val;
                    else die($langAr['skype']); //Защита от дурака
                }
            }
            elseif($key == 'AVATAR')
            {
               if($val['name'] !== '' || $val['error'] == 0)
               {
                   $file = CFile::SaveFile(
                       $val,
                       '/uf',
                       false,
                       false
                   );
                   $result['UF_PHOTO_PROFILE'] = $file;
               }
            }

        }
    }


        $USER = new CUser;
        $idUser = $USER->GetID();
        $USER->Update($idUser, $result);
        print_r(1);







