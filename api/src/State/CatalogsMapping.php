<?php

namespace App\State;

class CatalogsMapping
{
    public const UNASSIGNED = 'unassigned';

    private static array $catalogMapping = [
        'NG' => 'ngc',
        'IC' => 'ic',
        'LD' => 'ldn',
        'Sh' => 'sh',
        'Cr' => 'cr',
        'St' => 'sto',
        'Ab' => 'abl',
        'UG' => 'ugc',
        'An' => self::UNASSIGNED, 'Ap' => self::UNASSIGNED, 'AP' => self::UNASSIGNED,
        'He' => self::UNASSIGNED,
        'Ba' => self::UNASSIGNED, 'Be' => self::UNASSIGNED, 'Bi' => self::UNASSIGNED, 'Bo' => self::UNASSIGNED, 'Bv' => self::UNASSIGNED,
        'B1' => self::UNASSIGNED, 'B2' => self::UNASSIGNED, 'B3' => self::UNASSIGNED, 'B4' => self::UNASSIGNED, 'B5' => self::UNASSIGNED, 'B6' => self::UNASSIGNED, 'B7' => self::UNASSIGNED, 'B8' => self::UNASSIGNED, 'B9' => self::UNASSIGNED,
        'K1' => self::UNASSIGNED, 'K2' => self::UNASSIGNED, 'K3' => self::UNASSIGNED, 'K4' => self::UNASSIGNED,
        'M1' => self::UNASSIGNED, 'M2' => self::UNASSIGNED, 'M3' => self::UNASSIGNED, 'M4' => self::UNASSIGNED, 'M7' => self::UNASSIGNED,
        'Mr' => self::UNASSIGNED,
        'Na' => self::UNASSIGNED,
        'Cz' => 'cz',
        'Ki' => 'kin',
        'Do' => self::UNASSIGNED,
        'Pa' => self::UNASSIGNED, 'Pe' => self::UNASSIGNED,
        'Ce' => self::UNASSIGNED,
        'Ru' => self::UNASSIGNED,
        'Ly' => 'lyn',
        'Ha' => self::UNASSIGNED, 'Ho' => self::UNASSIGNED, 'Hu' => self::UNASSIGNED,
        'H1' => self::UNASSIGNED, 'H2' => self::UNASSIGNED,
        'vd' => self::UNASSIGNED,
        'Ca' => self::UNASSIGNED,
        'La' => self::UNASSIGNED,
        'Me' => self::UNASSIGNED,
        '3C' => self::UNASSIGNED,
        'Te' => self::UNASSIGNED, 'To' => self::UNASSIGNED, 'Tr' => self::UNASSIGNED,
        'Gu' => self::UNASSIGNED, 'Gr' => self::UNASSIGNED,
        'Pi' => self::UNASSIGNED,
        'Fe' => self::UNASSIGNED,
        'Ro' => self::UNASSIGNED,
        'Jo' => self::UNASSIGNED,
        'J3' => self::UNASSIGNED, 'J9' => self::UNASSIGNED,
        'Vd' => 'vdb', 'VV' => self::UNASSIGNED, 'vy' => self::UNASSIGNED, 'VY' => self::UNASSIGNED
    ];

    public function __invoke(): array
    {
        return self::$catalogMapping;
    }
}
