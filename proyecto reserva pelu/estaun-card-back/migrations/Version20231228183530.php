<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228183530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cliente_cita (cliente_id INT NOT NULL, cita_id INT NOT NULL, INDEX IDX_659E5205DE734E51 (cliente_id), INDEX IDX_659E52051E011DDF (cita_id), PRIMARY KEY(cliente_id, cita_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cliente_cita ADD CONSTRAINT FK_659E5205DE734E51 FOREIGN KEY (cliente_id) REFERENCES cita (id)');
        $this->addSql('ALTER TABLE cliente_cita ADD CONSTRAINT FK_659E52051E011DDF FOREIGN KEY (cita_id) REFERENCES cliente (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente_cita DROP FOREIGN KEY FK_659E5205DE734E51');
        $this->addSql('ALTER TABLE cliente_cita DROP FOREIGN KEY FK_659E52051E011DDF');
        $this->addSql('DROP TABLE cliente_cita');
    }
}
