<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310174430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__mep AS SELECT id, fullname, country, national_political_group FROM mep');
        $this->addSql('DROP TABLE mep');
        $this->addSql('CREATE TABLE mep (id INTEGER NOT NULL, fullname VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, national_political_group VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO mep (id, fullname, country, national_political_group) SELECT id, fullname, country, national_political_group FROM __temp__mep');
        $this->addSql('DROP TABLE __temp__mep');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__mep AS SELECT id, fullname, country, national_political_group FROM mep');
        $this->addSql('DROP TABLE mep');
        $this->addSql('CREATE TABLE mep (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, national_political_group VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO mep (id, fullname, country, national_political_group) SELECT id, fullname, country, national_political_group FROM __temp__mep');
        $this->addSql('DROP TABLE __temp__mep');
    }
}
