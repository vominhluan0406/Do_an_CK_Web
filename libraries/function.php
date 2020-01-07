<?php
function loaiXe($giatri)
{
    switch ($giatri) {
        case 'Côn tay':
            return 'CT';
        case 'Phân khối lớn ':
            return 'PKL';
        case 'Tay Ga':
            return 'TG';
        case 'Xe số':
            return 'SS';
        default:
            return '';
    }
}
