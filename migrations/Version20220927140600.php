<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927140600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game CHANGE riot_id riot_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE item ADD type VARCHAR(255) NOT NULL, CHANGE item_id item_id INT DEFAULT NULL, CHANGE gold_gain gold_gain INT DEFAULT NULL, CHANGE before_id before_id INT DEFAULT NULL, CHANGE after_id after_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP type, CHANGE item_id item_id INT NOT NULL, CHANGE gold_gain gold_gain INT NOT NULL, CHANGE before_id before_id INT NOT NULL, CHANGE after_id after_id INT NOT NULL');
        $this->addSql('ALTER TABLE game CHANGE riot_id riot_id INT NOT NULL');
    }
}
