<?php

return array(
    'class' => 'Trovebox\Common\Trovebox',
    
    'services' => array(

        'photos' => array(
            'alias' => 'Photos',
            'extends' => 'default_settings',
            'class' => 'Trovebox\Photo\PhotoClient'
        )
    )
);