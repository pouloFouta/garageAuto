<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903042437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('DROP INDEX IDX_5E9E89CB19EB6921 ON location');
        $this->addSql('ALTER TABLE location CHANGE client_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBA76ED395 ON location (user_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('DROP INDEX IDX_FE86641019EB6921 ON facture');
        $this->addSql('ALTER TABLE facture CHANGE client_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FE866410A76ED395 ON facture (user_id)');
        $this->addSql('DROP INDEX IDX_888A2A4C19EB6921 ON vente');
        $this->addSql('ALTER TABLE vente CHANGE client_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_888A2A4CA76ED395 ON vente (user_id)');
        $this->addSql('ALTER TABLE bon DROP FOREIGN KEY FK_FC7DFD6B19EB6921');
        $this->addSql('DROP INDEX IDX_FC7DFD6B19EB6921 ON bon');
        $this->addSql('ALTER TABLE bon CHANGE client_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon ADD CONSTRAINT FK_FC7DFD6BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FC7DFD6BA76ED395 ON bon (user_id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D19EB6921');
        $this->addSql('DROP INDEX IDX_292FFF1D19EB6921 ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE client_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1DA76ED395 ON vehicule (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bon DROP FOREIGN KEY FK_FC7DFD6BA76ED395');
        $this->addSql('DROP INDEX IDX_FC7DFD6BA76ED395 ON bon');
        $this->addSql('ALTER TABLE bon CHANGE user_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon ADD CONSTRAINT FK_FC7DFD6B19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FC7DFD6B19EB6921 ON bon (client_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410A76ED395');
        $this->addSql('DROP INDEX IDX_FE866410A76ED395 ON facture');
        $this->addSql('ALTER TABLE facture CHANGE user_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FE86641019EB6921 ON facture (client_id)');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBA76ED395');
        $this->addSql('DROP INDEX IDX_5E9E89CBA76ED395 ON location');
        $this->addSql('ALTER TABLE location CHANGE user_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5E9E89CB19EB6921 ON location (client_id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DA76ED395');
        $this->addSql('DROP INDEX IDX_292FFF1DA76ED395 ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE user_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_292FFF1D19EB6921 ON vehicule (client_id)');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4CA76ED395');
        $this->addSql('DROP INDEX IDX_888A2A4CA76ED395 ON vente');
        $this->addSql('ALTER TABLE vente CHANGE user_id client_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_888A2A4C19EB6921 ON vente (client_id)');
    }
}
