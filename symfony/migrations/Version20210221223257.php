<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221223257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'add currency';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
            INSERT INTO `cash` (`amount`, `ID`, `coin_value`)
            VALUES
                (5,1,0.05),
                (5,2,0.1),
                (5,3,0.25),
                (5,4,1)"
        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM cash");
    }
}
