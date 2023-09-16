<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218202943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB3256915B');
        $this->addSql('DROP INDEX IDX_5E9E89CB3256915B ON location');
        $this->addSql('ALTER TABLE location CHANGE relation_id voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB181A8BA ON location (voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB181A8BA');
        $this->addSql('DROP INDEX IDX_5E9E89CB181A8BA ON location');
        $this->addSql('ALTER TABLE location CHANGE voiture_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB3256915B FOREIGN KEY (relation_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB3256915B ON location (relation_id)');
    }
}
