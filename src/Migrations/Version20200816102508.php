<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200816102508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vehicule_id INT NOT NULL, date_vente DATETIME DEFAULT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_888A2A4C19EB6921 (client_id), UNIQUE INDEX UNIQ_888A2A4C4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('DROP TABLE achat');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vehicule_id INT NOT NULL, date_achat DATETIME DEFAULT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_26A9845619EB6921 (client_id), UNIQUE INDEX UNIQ_26A984564A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984564A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE vente');
    }
}
