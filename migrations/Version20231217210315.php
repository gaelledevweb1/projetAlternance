<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217210315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661AD5CDBF');
        $this->addSql('DROP INDEX IDX_23A0E661AD5CDBF ON article');
        $this->addSql('ALTER TABLE article ADD article_image VARCHAR(255) NOT NULL, ADD article_stock_quantify VARCHAR(255) NOT NULL, DROP cart_id, DROP article_images, DROP article_stock_quantity, CHANGE sellprice_ht sell_price_ht DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD cart_id INT DEFAULT NULL, ADD article_images VARCHAR(255) NOT NULL, ADD article_stock_quantity VARCHAR(255) NOT NULL, DROP article_image, DROP article_stock_quantify, CHANGE sell_price_ht sellprice_ht DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_23A0E661AD5CDBF ON article (cart_id)');
    }
}
