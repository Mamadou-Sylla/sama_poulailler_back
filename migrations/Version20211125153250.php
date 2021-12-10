<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211125153250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD poussin_id INT DEFAULT NULL, ADD poulet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F4440098 FOREIGN KEY (poussin_id) REFERENCES poussin (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F2888615 FOREIGN KEY (poulet_id) REFERENCES poulet (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F4440098 ON user (poussin_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F2888615 ON user (poulet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F4440098');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F2888615');
        $this->addSql('DROP INDEX IDX_8D93D649F4440098 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649F2888615 ON user');
        $this->addSql('ALTER TABLE user DROP poussin_id, DROP poulet_id');
    }
}
