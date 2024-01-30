<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111141340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credentials ADD roles JSON NOT NULL, ADD is_verified TINYINT(1) NOT NULL, CHANGE user_email user_email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA05280E550872C ON credentials (user_email)');
        $this->addSql('ALTER TABLE user DROP role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_FA05280E550872C ON credentials');
        $this->addSql('ALTER TABLE credentials DROP roles, DROP is_verified, CHANGE user_email user_email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) NOT NULL');
    }
}
