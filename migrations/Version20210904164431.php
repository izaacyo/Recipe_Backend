<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210904164431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipes ADD COLUMN image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipes AS SELECT id, name, time, difficulty, portions, ingredients, instructions FROM recipes');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('CREATE TABLE recipes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, time VARCHAR(20) NOT NULL, difficulty VARCHAR(30) NOT NULL, portions VARCHAR(30) NOT NULL, ingredients CLOB NOT NULL --(DC2Type:array)
        , instructions CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO recipes (id, name, time, difficulty, portions, ingredients, instructions) SELECT id, name, time, difficulty, portions, ingredients, instructions FROM __temp__recipes');
        $this->addSql('DROP TABLE __temp__recipes');
    }
}
