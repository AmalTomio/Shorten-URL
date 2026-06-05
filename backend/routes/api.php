<?php

return [

    [
        'POST',
        '/api/shorten',
        'shorten'
    ],

    [
        'GET',
        '/{code}',
        'redirect'
    ],

];