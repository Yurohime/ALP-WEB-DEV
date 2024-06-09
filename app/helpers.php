<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($demuni)
    {
        return 'Rp. ' . number_format($demuni, 0, ',', '.') . ',-';
    }
}