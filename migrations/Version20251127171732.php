<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127171732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tb_cliente (id_cliente SERIAL NOT NULL, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(50) NOT NULL, email VARCHAR(100) DEFAULT NULL, direccion VARCHAR(50) NOT NULL, telefono VARCHAR(20) DEFAULT NULL, dpi VARCHAR(15) NOT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id_cliente))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE tb_cliente');
    }
}
