<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221205259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Insert Products';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
                        INSERT INTO `Product` (`code`, `name`, `price`, `stock`, `ID`)
                        VALUES
                            ('B5023','soda',1.9,5,1),
                            ('A1024','chips',5.05,4,2),
                            ('A1024','cheese sticks',5.35,5,3),
                            ('C8792','Jelly beans',2.3,5,4),
                            ('G7603','Peanuts',1.3,6,5),
                            ('T0291','Water',0.6,10,6),
                            ('R5782','Cookies',3.6,8,7)"
        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM Product");
    }
}
