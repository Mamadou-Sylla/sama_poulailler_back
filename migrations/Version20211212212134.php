<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211212212134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aliment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, quantite INT NOT NULL, prix_total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, prix_total INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, quantite VARCHAR(255) NOT NULL, prix_total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuf (id INT AUTO_INCREMENT NOT NULL, nbre_total INT NOT NULL, nbre_casses INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, prix_total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poulailler ADD medicament_id INT DEFAULT NULL, ADD aliment_id INT DEFAULT NULL, ADD depense_id INT DEFAULT NULL, ADD vente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF892630AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF892630415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id)');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF89263041D81563 FOREIGN KEY (depense_id) REFERENCES depense (id)');
        $this->addSql('ALTER TABLE poulailler ADD CONSTRAINT FK_FF8926307DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE INDEX IDX_FF892630AB0D61F7 ON poulailler (medicament_id)');
        $this->addSql('CREATE INDEX IDX_FF892630415B9F11 ON poulailler (aliment_id)');
        $this->addSql('CREATE INDEX IDX_FF89263041D81563 ON poulailler (depense_id)');
        $this->addSql('CREATE INDEX IDX_FF8926307DC7170A ON poulailler (vente_id)');
        $this->addSql('ALTER TABLE poulet ADD oeuf_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poulet ADD CONSTRAINT FK_F34C04D3ED4A6D9 FOREIGN KEY (oeuf_id) REFERENCES oeuf (id)');
        $this->addSql('CREATE INDEX IDX_F34C04D3ED4A6D9 ON poulet (oeuf_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF892630415B9F11');
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF89263041D81563');
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF892630AB0D61F7');
        $this->addSql('ALTER TABLE poulet DROP FOREIGN KEY FK_F34C04D3ED4A6D9');
        $this->addSql('ALTER TABLE poulailler DROP FOREIGN KEY FK_FF8926307DC7170A');
        $this->addSql('DROP TABLE aliment');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE oeuf');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP INDEX IDX_FF892630AB0D61F7 ON poulailler');
        $this->addSql('DROP INDEX IDX_FF892630415B9F11 ON poulailler');
        $this->addSql('DROP INDEX IDX_FF89263041D81563 ON poulailler');
        $this->addSql('DROP INDEX IDX_FF8926307DC7170A ON poulailler');
        $this->addSql('ALTER TABLE poulailler DROP medicament_id, DROP aliment_id, DROP depense_id, DROP vente_id');
        $this->addSql('DROP INDEX IDX_F34C04D3ED4A6D9 ON poulet');
        $this->addSql('ALTER TABLE poulet DROP oeuf_id');
    }
}
