<?php

namespace src\Models\Proprietarios;

use MF\Entity\Entity;

class ProprietariosEntity extends Entity {
    const main_table = 'proprietarios';

    public int $idProprietario;
    public string $proprietario;
    public int $idFamilia; 
}