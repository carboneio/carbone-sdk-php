<?php

function getTemplate(): string
{
    return file_get_contents(__DIR__ . '/Assets/template.odt');
}

function getTemplateAsBase64(): string
{
    return base64_encode(file_get_contents(__DIR__ . '/Assets/template.odt'));
}

function getResult(): string
{
    return file_get_contents(__DIR__ . '/Assets/result.pdf');
}
