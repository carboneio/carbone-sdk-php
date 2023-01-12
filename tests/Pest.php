<?php

function getTemplateAsBase64(): string
{
    return base64_encode(file_get_contents(__DIR__ . '/Assets/template.odt'));
}

function getResultAsPdf(): string
{
    return base64_encode(file_get_contents(__DIR__ . '/Assets/result.pdf'));
}