<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927134936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, summoner_id INT DEFAULT NULL, date DATE NOT NULL, duree INT NOT NULL, win TINYINT(1) NOT NULL, riot_id INT NOT NULL, INDEX IDX_232B318CBC01C675 (summoner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inhibiter_kill (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, assistance LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', bounty INT NOT NULL, player_id INT NOT NULL, position_x INT NOT NULL, position_y INT NOT NULL, team_id INT NOT NULL, timestamp INT NOT NULL, INDEX IDX_C600F34E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, item_id INT NOT NULL, player_id INT NOT NULL, timestamp INT NOT NULL, gold_gain INT NOT NULL, before_id INT NOT NULL, after_id INT NOT NULL, INDEX IDX_1F1B251EE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `kill` (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, assistance LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', bounty INT NOT NULL, killer_id INT NOT NULL, killer_streak INT NOT NULL, position_x INT NOT NULL, position_y INT NOT NULL, shutdown_bounty INT NOT NULL, timestamp INT NOT NULL, victime_id INT NOT NULL, INDEX IDX_7295669E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif_kill (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, assistance LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', bounty INT NOT NULL, player_id INT NOT NULL, position_x INT NOT NULL, position_y INT NOT NULL, team_id INT NOT NULL, timestamp INT NOT NULL, monster_type VARCHAR(255) NOT NULL, sub_monster_type VARCHAR(255) NOT NULL, INDEX IDX_7672ACE3E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plate (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, player_id INT NOT NULL, position_x INT NOT NULL, position_y INT NOT NULL, team_id INT NOT NULL, timestamp INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_719ED75BE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, sumonner_name VARCHAR(255) NOT NULL, champion_name VARCHAR(255) NOT NULL, level INT NOT NULL, player_kill INT NOT NULL, player_death INT NOT NULL, player_assistance INT NOT NULL, first_rune VARCHAR(255) NOT NULL, second_rune VARCHAR(255) NOT NULL, first_summoner VARCHAR(255) NOT NULL, second_summoner VARCHAR(255) NOT NULL, team_id INT NOT NULL, cs INT NOT NULL, vision_score INT NOT NULL, post VARCHAR(255) NOT NULL, id_in_game INT NOT NULL, INDEX IDX_98197A65E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE summoner (id INT AUTO_INCREMENT NOT NULL, summerner VARCHAR(255) NOT NULL, puuid VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tower_kill (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, tower_type VARCHAR(255) NOT NULL, assistance LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', bounty INT NOT NULL, player_id INT NOT NULL, position_x INT NOT NULL, position_y INT NOT NULL, team_id INT NOT NULL, timestamp INT NOT NULL, INDEX IDX_3A2D858FE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ward (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, player_id INT NOT NULL, timestamp INT NOT NULL, type VARCHAR(255) NOT NULL, ward_type VARCHAR(255) NOT NULL, INDEX IDX_C96F581BE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CBC01C675 FOREIGN KEY (summoner_id) REFERENCES summoner (id)');
        $this->addSql('ALTER TABLE inhibiter_kill ADD CONSTRAINT FK_C600F34E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE `kill` ADD CONSTRAINT FK_7295669E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE objectif_kill ADD CONSTRAINT FK_7672ACE3E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE plate ADD CONSTRAINT FK_719ED75BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE tower_kill ADD CONSTRAINT FK_3A2D858FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE ward ADD CONSTRAINT FK_C96F581BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CBC01C675');
        $this->addSql('ALTER TABLE inhibiter_kill DROP FOREIGN KEY FK_C600F34E48FD905');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EE48FD905');
        $this->addSql('ALTER TABLE `kill` DROP FOREIGN KEY FK_7295669E48FD905');
        $this->addSql('ALTER TABLE objectif_kill DROP FOREIGN KEY FK_7672ACE3E48FD905');
        $this->addSql('ALTER TABLE plate DROP FOREIGN KEY FK_719ED75BE48FD905');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65E48FD905');
        $this->addSql('ALTER TABLE tower_kill DROP FOREIGN KEY FK_3A2D858FE48FD905');
        $this->addSql('ALTER TABLE ward DROP FOREIGN KEY FK_C96F581BE48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE inhibiter_kill');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE `kill`');
        $this->addSql('DROP TABLE objectif_kill');
        $this->addSql('DROP TABLE plate');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE summoner');
        $this->addSql('DROP TABLE tower_kill');
        $this->addSql('DROP TABLE ward');
    }
}
