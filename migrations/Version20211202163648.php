<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211202163648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poulailler ADD poulet_id INT DEFAULT NULL, ADD poussin_id INT DEFAULT NULL, ADD employes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF892630F2888615 FOREIGN KEY (poulet_id) REFERENCES poulet (id)');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF892630F4440098 FOREIGN KEY (poussin_id) REFERENCES poussin (id)');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF892630F971F91F FOREIGN KEY (employes_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_FF892630F2888615 ON poulailler (poulet_id)');
        $this->addSql('CREATE INDEX IDX_FF892630F4440098 ON poulailler (poussin_id)');
        $this->addSql('CREATE INDEX IDX_FF892630F971F91F ON poulailler (employes_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F4440098');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F2888615');
        $this->addSql('DROP INDEX IDX_8D93D649F4440098 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649F2888615 ON user');
        $this->addSql('ALTER TABLE user ADD poulailler_id INT DEFAULT NULL, DROP poussin_id, DROP poulet_id');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649159098FF FOREIGN KEY (poulailler_id) REFERENCES poulailler (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649159098FF ON user (poulailler_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9BF396750');
        $this->addSql('ALTER TABLE employe CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF892630F2888615');
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF892630F4440098');
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF892630F971F91F');
        $this->addSql('DROP INDEX IDX_FF892630F2888615 ON poulailler');
        $this->addSql('DROP INDEX IDX_FF892630F4440098 ON poulailler');
        $this->addSql('DROP INDEX IDX_FF892630F971F91F ON poulailler');
        $this->addSql('ALTER TABLE poulailler DROP poulet_id, DROP poussin_id, DROP employes_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649159098FF');
        $this->addSql('DROP INDEX IDX_8D93D649159098FF ON user');
        $this->addSql('ALTER TABLE user ADD poulet_id INT DEFAULT NULL, CHANGE poulailler_id poussin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F4440098 FOREIGN KEY (poussin_id) REFERENCES poussin (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F2888615 FOREIGN KEY (poulet_id) REFERENCES poulet (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F4440098 ON user (poussin_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F2888615 ON user (poulet_id)');
    }
}
