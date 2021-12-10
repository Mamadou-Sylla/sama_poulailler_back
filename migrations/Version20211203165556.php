<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203165556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poulailler ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF8926301B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_FF8926301B65292 ON poulailler (employe_id)');
        $this->addSql('ALTER TABLE user CHANGE telephone telephone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF8926301B65292');
        $this->addSql('DROP INDEX IDX_FF8926301B65292 ON poulailler');
        $this->addSql('ALTER TABLE poulailler DROP employe_id');
        $this->addSql('ALTER TABLE user CHANGE telephone telephone INT NOT NULL');
    }
}
