<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927132405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inhibiter_kill CHANGE timestamp timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE item CHANGE timestamp timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE `kill` CHANGE timestamp timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE objectif_kill CHANGE timestamp timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE plate CHANGE timestamp timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE tower_kill CHANGE timestamp timestamp INT NOT NULL');
        $this->addSql('ALTER TABLE ward CHANGE timestamp timestamp INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item CHANGE timestamp timestamp TIME NOT NULL');
        $this->addSql('ALTER TABLE plate CHANGE timestamp timestamp TIME NOT NULL');
        $this->addSql('ALTER TABLE ward CHANGE timestamp timestamp TIME NOT NULL');
        $this->addSql('ALTER TABLE inhibiter_kill CHANGE timestamp timestamp TIME NOT NULL');
        $this->addSql('ALTER TABLE `kill` CHANGE timestamp timestamp TIME NOT NULL');
        $this->addSql('ALTER TABLE objectif_kill CHANGE timestamp timestamp TIME NOT NULL');
        $this->addSql('ALTER TABLE tower_kill CHANGE timestamp timestamp TIME NOT NULL');
    }
}
