<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250117171944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP is_correct, CHANGE text text VARCHAR(255) NOT NULL, CHANGE correct_answer correct_answer TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE question DROP correct_answer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer ADD is_correct TINYINT(1) DEFAULT NULL, CHANGE text text VARCHAR(255) DEFAULT NULL, CHANGE correct_answer correct_answer TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE question ADD correct_answer VARCHAR(255) NOT NULL');
    }
}
