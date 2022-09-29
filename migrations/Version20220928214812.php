<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928214812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, match_id VARCHAR(255) NOT NULL, surrender15 TINYINT(1) NOT NULL, surrender TINYINT(1) NOT NULL, date DATETIME NOT NULL, duration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_event (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, events JSON NOT NULL, UNIQUE INDEX UNIQ_99D7328E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, summoner_name VARCHAR(255) NOT NULL, team_id INT NOT NULL, champion_name VARCHAR(255) NOT NULL, level INT NOT NULL, kills INT NOT NULL, death INT NOT NULL, assists INT NOT NULL, cs INT NOT NULL, post VARCHAR(255) NOT NULL, participant_id INT NOT NULL, vision_score INT NOT NULL, win TINYINT(1) NOT NULL, item1 INT NOT NULL, item2 INT NOT NULL, item3 INT NOT NULL, item4 INT NOT NULL, item5 INT NOT NULL, item6 INT NOT NULL, first_rune INT NOT NULL, second_rune INT NOT NULL, summoner1 INT NOT NULL, summoner2 INT NOT NULL, INDEX IDX_98197A65E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE summoner (id INT AUTO_INCREMENT NOT NULL, profile_icon_id INT NOT NULL, name VARCHAR(255) NOT NULL, puuid VARCHAR(255) NOT NULL, summoner_level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_event ADD CONSTRAINT FK_99D7328E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_event DROP FOREIGN KEY FK_99D7328E48FD905');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65E48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_event');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE summoner');
    }
}
