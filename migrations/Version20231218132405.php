<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218132405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT DEFAULT NULL, CHANGE street_number street_number VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE article ADD category_id INT DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE article_description article_description LONGTEXT DEFAULT NULL, CHANGE details details LONGTEXT DEFAULT NULL, CHANGE article_stock_quantity article_stock_quantity INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('ALTER TABLE cart ADD article_quantity INT NOT NULL, DROP article_quantify, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD category_images VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE address_id address_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE delivery_info delivery_info VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EFEE30A60');
        $this->addSql('DROP INDEX UNIQ_B1DC7A1EFEE30A60 ON paiement');
        $this->addSql('ALTER TABLE paiement DROP order1_id, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE user_id user_id INT NOT NULL, CHANGE street_number street_number INT NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE address_id address_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE cart_id cart_id INT NOT NULL, CHANGE delivery_info delivery_info LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD article_quantify VARCHAR(255) NOT NULL, DROP article_quantity, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement ADD order1_id INT NOT NULL, CHANGE cart_id cart_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EFEE30A60 FOREIGN KEY (order1_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1DC7A1EFEE30A60 ON paiement (order1_id)');
        $this->addSql('ALTER TABLE category DROP category_images');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2 ON article');
        $this->addSql('ALTER TABLE article DROP category_id, CHANGE cart_id cart_id INT NOT NULL, CHANGE article_stock_quantity article_stock_quantity VARCHAR(255) NOT NULL, CHANGE article_description article_description LONGTEXT NOT NULL, CHANGE details details LONGTEXT NOT NULL');
    }
}
