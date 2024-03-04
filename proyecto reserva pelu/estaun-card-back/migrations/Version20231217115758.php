<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217115758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY cliente_ibfk_1');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY cita_ibfk_1');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP TABLE personal_access_tokens');
        $this->addSql('DROP TABLE migrations');
        $this->addSql('DROP TABLE password_reset_tokens');
        $this->addSql('DROP TABLE oferta');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE failed_jobs');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP INDEX id_oferta ON cliente');
        $this->addSql('ALTER TABLE cliente ADD contrasena VARCHAR(255) NOT NULL, DROP id_oferta, DROP cod_cliente, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nombre nombre VARCHAR(60) NOT NULL, CHANGE apellidos apellidos VARCHAR(300) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cita (id INT UNSIGNED AUTO_INCREMENT NOT NULL, id_cliente INT UNSIGNED NOT NULL, aetc VARCHAR(1) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, hora DATETIME DEFAULT NULL, tematica VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, precio DOUBLE PRECISION DEFAULT NULL, INDEX id_cliente (id_cliente), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personal_access_tokens (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, tokenable_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, tokenable_id BIGINT UNSIGNED NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, token VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, abilities TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, last_used_at DATETIME DEFAULT NULL, expires_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX personal_access_tokens_token_unique (token), INDEX personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type, tokenable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE migrations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, migration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, batch INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE password_reset_tokens (email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, token VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, created_at DATETIME DEFAULT NULL, PRIMARY KEY(email)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE oferta (id INT UNSIGNED AUTO_INCREMENT NOT NULL, descuento DOUBLE PRECISION DEFAULT NULL, nombre VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, email_verified_at DATETIME DEFAULT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, two_factor_secret TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, two_factor_recovery_codes TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, two_factor_confirmed_at DATETIME DEFAULT NULL, remember_token VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, current_team_id BIGINT UNSIGNED DEFAULT NULL, profile_photo_path VARCHAR(2048) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX users_email_unique (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE failed_jobs (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, uuid VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, connection TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, queue TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, payload LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, exception LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, failed_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX failed_jobs_uuid_unique (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sessions (id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, user_id BIGINT UNSIGNED DEFAULT NULL, ip_address VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, user_agent TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, payload LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, last_activity INT NOT NULL, INDEX sessions_last_activity_index (last_activity), INDEX sessions_user_id_index (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT cita_ibfk_1 FOREIGN KEY (id_cliente) REFERENCES oferta (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cliente ADD id_oferta INT UNSIGNED DEFAULT NULL, ADD cod_cliente VARCHAR(10) DEFAULT NULL, DROP contrasena, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE nombre nombre VARCHAR(100) DEFAULT NULL, CHANGE apellidos apellidos VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT cliente_ibfk_1 FOREIGN KEY (id_oferta) REFERENCES oferta (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX id_oferta ON cliente (id_oferta)');
    }
}
