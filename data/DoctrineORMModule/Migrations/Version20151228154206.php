<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151228154206 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE owners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, tsAdd INT NOT NULL, tsMod INT DEFAULT NULL, companyId INT DEFAULT NULL, UNIQUE INDEX UNIQ_427292FA2480E723 (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, address LONGTEXT NOT NULL, city VARCHAR(100) NOT NULL, country VARCHAR(100) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, tsAdd INT NOT NULL, tsMod INT DEFAULT NULL, UNIQUE INDEX UNIQ_8244AA3A5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE owners ADD CONSTRAINT FK_427292FA2480E723 FOREIGN KEY (companyId) REFERENCES companies (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE owners DROP FOREIGN KEY FK_427292FA2480E723');
        $this->addSql('DROP TABLE owners');
        $this->addSql('DROP TABLE companies');
    }
}
