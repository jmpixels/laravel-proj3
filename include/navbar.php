<?php 

$current_page = basename($_SERVER['PHP_SELF']);

$menuItems = [
    [
        'text' => 'Articles',
        'icon' => 'fa-solid fa-file-lines icon',
        'links' => [

            // Sub menus
            ['label' => 'All Articles', 'url' => 'articles.php'],
            ['label' => 'Categories', 'url' => 'categories.php']
        ],
        'isActive' => in_array($current_page, ['articles.php', 'categories.php'])
    ],
    [
        'text' => 'Team Members',
        'icon' => 'fa-solid fa-user-group icon',
        'links' => [['label' => 'Team Members', 'url' => 'team.php']],
        'isActive' => ($current_page === 'team.php')
    ],
    
    [
        'text' => 'Products',
        'icon' => 'fa-solid fa-box-archive icon',
        'links' => [

            // Sub menus
            ['label' => 'All Products', 'url' => 'all-products.php'],
            ['label' => 'Add Products', 'url' => 'add-products.php'],
            ['label' => 'Categories', 'url' => 'categories.php'],
            ['label' => 'Tags', 'url' => 'tags.php']
        ],
        'isActive' => in_array($current_page, ['products.php', 'all-products.php', 'add-products.php', 'categories.php', 'tags.php'])
    ],
    [
        'text' => 'Settings',
        'icon' => 'fa-solid fa-gear icon',
        'links' => [

            // Sub menus
            ['label' => 'Users', 'url' => 'users.php'],
            ['label' => 'Mail', 'url' => '#'],
            ['label' => 'Languages', 'url' => '#']
        ],
        'isActive' => in_array($current_page, ['settings.php', 'users.php'])
    ],
    [
        'text' => 'Logout',
        'icon' => 'fa-solid fa-right-from-bracket icon',
        'links' => [['label' => 'Logout', 'url' => 'logout.php']],
        'isActive' => ($current_page === 'logout.php')
    ]
];

$navbar = '';


$navbar .= 
'

<div class="sidebar" id="sidebar">
    <div class="side-wrapper">
        <div class="logo-container">
            <img class="side-logo" src="img/logo_white.png" alt="">
        </div>
        <nav>
            <ul>
';


foreach ($menuItems as $menuItem) {
    // Check if the menu item has sub-menus
    $hasSubMenus = count($menuItem['links']) > 1;

    // Determine the class based on whether the menu item is active and has sub-menus
    $itemClass = 'link ' . ($menuItem['isActive'] ? 'active ' : '') . ($hasSubMenus ? 's-menu' : '');

    $navbar .= '<div class="' . $itemClass . '">';

    if (count($menuItem['links']) === 1) {
        $navbar .= '<a href="' . $menuItem['links'][0]['url'] . '" class="page-link">';
        $navbar .= '<i class="' . $menuItem['icon'] . '"></i> ' . $menuItem['text'];
        $navbar .= '</a>';
    } else {
        $navbar .= '<a href="#" class="page-link">';
        $navbar .= '<i class="' . $menuItem['icon'] . '"></i> ' . $menuItem['text'];
        $navbar .= '</a>';
        $navbar .= '<div class="sub-menu">';
        foreach ($menuItem['links'] as $subLink) {
            $navbar .= '<a href="' . $subLink['url'] . '" ' . ($subLink['url'] === $current_page ? 'class="active"' : '') . '>';
            $navbar .= $subLink['label'];
            $navbar .= '</a>';
        }
        $navbar .= '</div>';
    }

    $navbar .= '</div>';
}

$navbar .=
'
</ul>
        </nav>
    </div>
</div>
<script src="script/nav.js"></script>
';

?>


