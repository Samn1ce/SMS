<?php
function formatName(string $name): string {
    return mb_convert_case(trim($name), MB_CASE_TITLE, 'UTF-8');
}