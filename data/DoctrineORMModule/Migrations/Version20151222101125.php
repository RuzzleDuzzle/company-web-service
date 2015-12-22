<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151222101125 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE owners (id INT AUTO_INCREMENT NOT NULL, firstName VARCHAR(100) NOT NULL, lastName VARCHAR(100) NOT NULL, email VARCHAR(100) DEFAULT NULL, tsAdd INT NOT NULL, tsMod INT DEFAULT NULL, companyId INT NOT NULL, INDEX IDX_427292FA2480E723 (companyId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, address LONGTEXT DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, tsAdd INT NOT NULL, tsMod INT DEFAULT NULL, countryId INT DEFAULT NULL, UNIQUE INDEX UNIQ_8244AA3A5E237E06 (name), INDEX IDX_8244AA3AFBA2A6B4 (countryId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, alpha2 VARCHAR(2) NOT NULL, alpha3 VARCHAR(3) NOT NULL, numCode INT NOT NULL, UNIQUE INDEX UNIQ_5D66EBAD5E237E06 (name), UNIQUE INDEX UNIQ_5D66EBADB762D672 (alpha2), UNIQUE INDEX UNIQ_5D66EBADC065E6E4 (alpha3), UNIQUE INDEX UNIQ_5D66EBAD8ACB87F2 (numCode), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE owners ADD CONSTRAINT FK_427292FA2480E723 FOREIGN KEY (companyId) REFERENCES companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE companies ADD CONSTRAINT FK_8244AA3AFBA2A6B4 FOREIGN KEY (countryId) REFERENCES countries (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE owners DROP FOREIGN KEY FK_427292FA2480E723');
        $this->addSql('ALTER TABLE companies DROP FOREIGN KEY FK_8244AA3AFBA2A6B4');
        $this->addSql('DROP TABLE owners');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE countries');
    }
}
