<?php

return [
    'menus' => [
        [
            'name' => 'Loyiha haqida',
            'dropdown' => true,
            'items' => [
                ['name' => 'Loyihaning maqsadi va vazifalari', 'link' => '/user/about/goals'],
                ['name' => 'Loyihani ishtirokchilari', 'link' => '/user/about/participants'],
                ['name' => "Loyiha bo'yicha kitoblar", 'link' => '/user/about/books'],
                ['name' => "Loyiha bo'yicha maqolalar", 'link' => '/user/about/articles'],
                ['name' => 'OAV biz haqimizda', 'link' => '#'],
                ['name' => 'Platforma haqida', 'link' => '#']
            ],
        ],
        [
            'name' => 'Ilmiy tadqiqotlar',
            'dropdown' => true,
            'items' => [
                ['name' => 'Dissertatsiyalar', 'link' => '/user/scientific/dissertations'],
                ['name' => 'Avtoreferatlar', 'link' => '/user/scientific/abstracts'],
                ['name' => 'Monografiyalar', 'link' => '/user/scientific/monographs'],
                ['name' => 'Maqolalar', 'link' => '/user/scientific/articles'],
                ['name' => 'Komparativist olimlar', 'link' => '#'],
            ],
        ],
        [
            'name' => 'Ilmiy jurnallar',
            'dropdown' => true,
            'items' => [
                ['name' => 'Yevropa', 'link' => '/user/magazines/yevropa'],
                ['name' => 'Amerika', 'link' => '/user/magazines/amerika'],
                ['name' => 'Turkiya', 'link' => '/user/magazines/turkiya'],
                ['name' => 'Rossiya', 'link' => '/user/magazines/rossiya'],
                ['name' => 'Markaziy Osiyo', 'link' => '/user/magazines/centralasia']
            ],
        ],
        [
            'name' => 'O‘quv adabiyotlari',
            'dropdown' => true,
            'items' => [
                ['name' => 'Darsliklar', 'link' => '/user/literature/textbooks'],
                ['name' => "O'quv qo'llanmalar", 'link' => '/user/literature/manuals'],
                ['name' => "Metodik qo'llanmalar", 'link' => '#'],
            ],
        ],
        [
            'name' => 'Xizmatlar',
            'dropdown' => true,
            'items' => [
                ['name' => 'Imtihonga tayyorlash', 'link' => '#'],
                ['name' => "Tadqiqotlarni o'rgatish", 'link' => '#'],
                ['name' => 'Onlayn maruza', 'link' => '#'],
            ],
        ],
        [
            'name' => 'Galereya',
            'dropdown' => true,
            'items' => [
                ['name' => 'Rasmlar', 'link' => '/user/gallery/photos'],
                ['name' => 'Video lavhalar', 'link' => '/user/gallery/videos'],
            ],
        ],
        [
            'name' => 'Bizning jurnal',
            'dropdown' => true,
            'url' => '/journal',
        ],
        [
            'name' => 'Aloqa',
            'dropdown' => true,
            'url' => '/contact',
        ],
    ],
];
