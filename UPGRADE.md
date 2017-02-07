# Upgrade Notes

### Update from Version 1.4.x to Version 1.5
- Toolbox\Tools namespace changed to Toolbox\Tool (check & upgrade your website files!)

### Update from Version 1.5.x to Version 1.6
- **Attention!** 1.6 only works with Pimcore 4.4 and above!

### Update from Version 1.5 to Version 1.5.x, Version 1.6 to Version 1.6.1
- CKEditor Configuration change:

```php

//BEFORE
[
    "ckeditor" => [
    
        "styles" => [
            [
                'name' => 'test',
                'element' => 'p',
                'attributes' => ['class' => 'h5']
            ]
        ]
    ]
    
]

//AFTER
[
    "ckeditor" => [
    
        "globalStyleSets" => [
            "globalSet1" => [

                [
                    'name' => 'test',
                    'element' => 'p',
                    'attributes' => ['class' => 'globalSet1 A']
                ],
                [
                    'name' => 'test-2',
                    'element' => 'p',
                    'attributes' => ['class' => 'globalSet1 B']
                ]
                    
            ],
        ],
        
        "areaEditor" => [
        
            "uiColor" : "#efefef",
        
            "stylesSet" => [

                [
                    'name' => 'test',
                    'element' => 'p',
                    'attributes' => ['class' => 'custom1']
                ],
                [
                    'name' => 'test-2',
                    'element' => 'p',
                    'attributes' => ['class' => 'custom2']
                ]
                
            ],
        ],
        "objectEditor" => 
            [
                "uiColor" => "yellow",
                "stylesSet" => "globalSet1"
            ]
        ]
        
    ]
]
```

### Update from Version 1.6.x to Version 1.7.0

- New video configuration in `toolbox_configuration.php`:
 ```php
 
     "video" => [
         "videoOptions" => [
             "youtube" => [
                 "posterImageThumbnail" => NULL,
             ]
         ],
         (...)
     ]
 
 ```
 
 - Changes in DB table `document_elements`. All elements with type `video` should changed to `vhs`. Use this sql script:
 
 ``` sql
 update documents_elements set type = 'vhs' where type = 'video';
 ```