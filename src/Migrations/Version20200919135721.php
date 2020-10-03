<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919135721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mise_en_location (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT NOT NULL, prix_par_jour INT NOT NULL, statut_mise VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_5B3B3A154A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mise_en_location ADD CONSTRAINT FK_5B3B3A154A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE location ADD mise_en_location_id INT DEFAULT NULL, DROP statut_location');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBE80E93AD FOREIGN KEY (mise_en_location_id) REFERENCES mise_en_location (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBE80E93AD ON location (mise_en_location_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBE80E93AD');
        $this->addSql('DROP TABLE mise_en_location');
        $this->addSql('DROP INDEX IDX_5E9E89CBE80E93AD ON location');
        $this->addSql('ALTER TABLE location ADD statut_location VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP mise_en_location_id');
    }
}
