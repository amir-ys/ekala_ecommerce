<?php

return [
    /*
      | This option controls the default date show in all tables
      |
      | Supported: "diff-for-humans" , "carbon"
      */
    'show-date' => 'diff-for-humans',


    /*
     | This option controls the default date show in all tables
     |
     | Supported: "diff-for-humans" , "carbon"
     */
    'image' => [
        'sizes' => [

            'product' => [
                'small' => [350, 350],
                'large' => [900, 710],
            ],

            'blog' => [
                'large' => [645, 350],
            ],

            'slide' => [
                    \Modules\Slide\Enums\SlideType::BANNER_TOP_LEFT->value => [
                        'large' => [306, 125]
                    ],
                    \Modules\Slide\Enums\SlideType::SLIDER->value => [
                        'large' => [966, 410],
                    ],
                    \Modules\Slide\Enums\SlideType::BANNER_BOTTOM->value => [
                       'large' => [620, 100]
                    ]
            ],

        ]
    ]
];
