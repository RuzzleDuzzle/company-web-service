<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151224001809 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE companies ADD ownerId INT NOT NULL');
        $this->addSql('ALTER TABLE companies ADD CONSTRAINT FK_8244AA3AE05EFD25 FOREIGN KEY (ownerId) REFERENCES owners (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8244AA3AE05EFD25 ON companies (ownerId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE companies DROP FOREIGN KEY FK_8244AA3AE05EFD25');
        $this->addSql('DROP INDEX UNIQ_8244AA3AE05EFD25 ON companies');
        $this->addSql('ALTER TABLE companies DROP ownerId');
    }
}
