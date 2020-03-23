<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323144442 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE score score INT DEFAULT NULL');
        $this->addSql('CREATE INDEX idx_score ON user (score)');
        $this->addSql('CREATE INDEX idx_last_name ON user (last_name)');
        $this->addSql('CREATE INDEX idx_first_name ON user (first_name)');
        $this->addSql('CREATE INDEX idx_phone ON user (phone)');
        $this->addSql('CREATE INDEX idx_personal_data ON user (personal_data)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX idx_score ON user');
        $this->addSql('DROP INDEX idx_last_name ON user');
        $this->addSql('DROP INDEX idx_first_name ON user');
        $this->addSql('DROP INDEX idx_phone ON user');
        $this->addSql('DROP INDEX idx_personal_data ON user');
        $this->addSql('ALTER TABLE user CHANGE score score INT DEFAULT NULL');
    }
}
