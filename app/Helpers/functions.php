<?php

function rupiah(float $moneyNumber) : string {
    return 'Rp. ' . number_format($moneyNumber, 2);
}