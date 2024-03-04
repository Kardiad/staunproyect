<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228184319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente ADD id_oferta INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25524E7D1F FOREIGN KEY (id_oferta) REFERENCES oferta (id)');
        $this->addSql('CREATE INDEX IDX_F41C9B25524E7D1F ON cliente (id_oferta)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25524E7D1F');
        $this->addSql('DROP INDEX IDX_F41C9B25524E7D1F ON cliente');
        $this->addSql('ALTER TABLE cliente DROP id_oferta');
    }
}
