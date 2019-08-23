<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190809014505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE achat ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_26A9845619EB6921 ON achat (client_id)');
        $this->addSql('ALTER TABLE bon_reparation ADD reparation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_reparation ADD CONSTRAINT FK_D3FBE23797934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('CREATE INDEX IDX_D3FBE23797934BA ON bon_reparation (reparation_id)');
        $this->addSql('ALTER TABLE commande ADD reparation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D97934BA ON commande (reparation_id)');
        $this->addSql('ALTER TABLE location ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB19EB6921 ON location (client_id)');
        $this->addSql('ALTER TABLE reparation ADD facture_id INT DEFAULT NULL, ADD numero_chassis_id INT DEFAULT NULL, ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D66C37A8A FOREIGN KEY (numero_chassis_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_8FDF219D7F2DEE08 ON reparation (facture_id)');
        $this->addSql('CREATE INDEX IDX_8FDF219D66C37A8A ON reparation (numero_chassis_id)');
        $this->addSql('CREATE INDEX IDX_8FDF219D670C757F ON reparation (fournisseur_id)');
        $this->addSql('ALTER TABLE vehicule ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D19EB6921 ON vehicule (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845619EB6921');
        $this->addSql('DROP INDEX IDX_26A9845619EB6921 ON achat');
        $this->addSql('ALTER TABLE achat DROP client_id');
        $this->addSql('ALTER TABLE bon_reparation DROP FOREIGN KEY FK_D3FBE23797934BA');
        $this->addSql('DROP INDEX IDX_D3FBE23797934BA ON bon_reparation');
        $this->addSql('ALTER TABLE bon_reparation DROP reparation_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D97934BA');
        $this->addSql('DROP INDEX IDX_6EEAA67D97934BA ON commande');
        $this->addSql('ALTER TABLE commande DROP reparation_id');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('DROP INDEX IDX_5E9E89CB19EB6921 ON location');
        $this->addSql('ALTER TABLE location DROP client_id');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D7F2DEE08');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D66C37A8A');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D670C757F');
        $this->addSql('DROP INDEX IDX_8FDF219D7F2DEE08 ON reparation');
        $this->addSql('DROP INDEX IDX_8FDF219D66C37A8A ON reparation');
        $this->addSql('DROP INDEX IDX_8FDF219D670C757F ON reparation');
        $this->addSql('ALTER TABLE reparation DROP facture_id, DROP numero_chassis_id, DROP fournisseur_id');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D19EB6921');
        $this->addSql('DROP INDEX IDX_292FFF1D19EB6921 ON vehicule');
        $this->addSql('ALTER TABLE vehicule DROP client_id');
    }
}
