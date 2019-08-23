<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190801224640 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE panne CHANGE motif motif LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE numero_chassis numero_chassis VARCHAR(17) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_292FFF1DF39D6D7E ON vehicule (numero_chassis)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE panne CHANGE motif motif VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_292FFF1DF39D6D7E ON vehicule');
        $this->addSql('ALTER TABLE vehicule CHANGE numero_chassis numero_chassis VARCHAR(9) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
