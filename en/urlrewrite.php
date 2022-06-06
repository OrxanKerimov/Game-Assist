<?php
$arUrlRewrite=array (
    1 =>
        array (
            'CONDITION' => '#^/rest/#',
            'RULE' => '',
            'ID' => NULL,
            'PATH' => '/bitrix/services/rest/index.php',
            'SORT' => 100,
        ),
  2 =>
  array (
    'CONDITION' => '#^/uslugi/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/uslugi/index.php',
    'SORT' => 100,
  ),
    3 =>
        array (
            'CONDITION' => '#^/uslugi/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/uslugi/detail.php',
            'SORT' => 100,
        ),
    4 =>
        array (
            'CONDITION' => '#^/uslugi/lbz_[1-2]/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/uslugi/detail.php',
            'SORT' => 100,
        ),
    5=>
        array (
            'CONDITION' => '#^/en/uslugi/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/en/uslugi/detail.php',
            'SORT' => 100,
        ),
    6 =>
        array (
            'CONDITION' => '#^/en/uslugi/lbz_[1-2]/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/en/uslugi/detail.php',
            'SORT' => 100,
        ),


);
