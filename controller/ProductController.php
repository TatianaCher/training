<?php #3.3.1 6

/* 
 ProductController.php
 * Контроллер страницы товара(/product/1) 
 * вернула не ЧПУ controller=category&id
 */

// подключаем модели
//include_once '../models/ProductsModel.php'; //модель для работы с товаром
//include_once '../models/CategoriesModel.php';

/**
 * Формирование страницы продуктов
 * 
 * @param object $smarty шаблонизатор из config.php через index.php
 */
function indexAction($smarty){ // формирование старанички товаров
   
    $itemId = isset($_GET['id']) ? $_GET['id'] : null;
    //d($itemId);
   
    if($itemId == null) {exit();} // if( !$itemId) exit();
    echo "Тест - {$itemId} . Cтраница продуктов";
    // получить данные продукта
    $rsProduct = getProductById($itemId); // набор данных определенного продукта из функции
 
    // получить все категории 
    $rsCategories = getAllMainCatsWithChildren();  // набор данных категории с их дочерними параметрами для формирования главной строки сайта
     // инициализация переменных smarty 
   
    
    #  #3.6       min 13 sec 27
    $smarty->assign('itemInCart', 0); // есть ли в корзине itemIn, его нет = 0
    if(in_array($itemId, $_SESSION['cart'])) { 
    $smarty->assign('itemInCart', 1); //  то itemsInCart = 1: переменная "флаг"
    }
    
    $smarty->assign('pageTitle', ''); // заголовок страниц передаем пустую строку
    
    $smarty->assign('rsCategories', $rsCategories);//формирование левого меню
    $smarty->assign('rsProduct', $rsProduct);//передать шаблон данного продукта 
  
    // d($rsProduct);
    
    //#3.3.1 6 min 19 sec
    loadTemplate($smarty, 'header'); // шаблон заголовка
    loadTemplate($smarty, 'product'); //шаблон центра страницы продуктов
    loadTemplate($smarty, 'footer'); // 'шаблоны страниц'
     
}