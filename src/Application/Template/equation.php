<?php

return [
    'rel' => 'equation',
    'href' => "/api/equations/{$equation->getId()}",
    'id' => $equation->getId(),
    'expression' => $equation->getExpression(),
    'result' => $equation->getResult(),
];
