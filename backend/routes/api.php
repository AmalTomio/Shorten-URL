<?php

return [

    [
        'GET',
        '/api/health',
        'health'
    ],

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