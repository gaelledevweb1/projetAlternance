<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130112450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, street_name VARCHAR(255) NOT NULL, street_number INT NOT NULL, city VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, cart_id INT DEFAULT NULL, article_ref VARCHAR(255) NOT NULL, article_name VARCHAR(255) NOT NULL, article_images VARCHAR(255) NOT NULL, article_thumbnails VARCHAR(255) NOT NULL, article_stock_quantity VARCHAR(255) NOT NULL, article_description LONGTEXT NOT NULL, bought_price DOUBLE PRECISION NOT NULL, sellprice_ht DOUBLE PRECISION NOT NULL, sell_price_ttc DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, details LONGTEXT NOT NULL, INDEX IDX_23A0E6612469DE2 (category_id), INDEX IDX_23A0E661AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credentials (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, user_name VARCHAR(255) NOT NULL, user_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FA05280EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, user_id INT NOT NULL, cart_id INT NOT NULL, order_date DATETIME NOT NULL, paid TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, delivered TINYINT(1) NOT NULL, delivery_date DATETIME NOT NULL, delivery_info LONGTEXT NOT NULL, INDEX IDX_F5299398F5B7AF75 (address_id), INDEX IDX_F5299398A76ED395 (user_id), UNIQUE INDEX UNIQ_F52993981AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, user_id INT NOT NULL, order1_id INT NOT NULL, bank_name VARCHAR(255) NOT NULL, card_name VARCHAR(255) NOT NULL, card_number VARCHAR(255) NOT NULL, card_network VARCHAR(255) NOT NULL, card_holdername VARCHAR(255) NOT NULL, expiration_date DATE NOT NULL, cvccode VARCHAR(255) NOT NULL, security_card VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B1DC7A1E1AD5CDBF (cart_id), UNIQUE INDEX UNIQ_B1DC7A1EA76ED395 (user_id), UNIQUE INDEX UNIQ_B1DC7A1EFEE30A60 (order1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE credentials ADD CONSTRAINT FK_FA05280EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EFEE30A60 FOREIGN KEY (order1_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661AD5CDBF');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE credentials DROP FOREIGN KEY FK_FA05280EA76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F5B7AF75');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981AD5CDBF');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E1AD5CDBF');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA76ED395');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EFEE30A60');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE credentials');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
