<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126115848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poulailler ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF8926301B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_FF8926301B65292 ON poulailler (employe_id)');
        $this->addSql('ALTER TABLE user ADD type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF8926301B65292');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP INDEX IDX_FF8926301B65292 ON poulailler');
        $this->addSql('ALTER TABLE poulailler DROP employe_id');
        $this->addSql('ALTER TABLE user DROP type');
    }
}
