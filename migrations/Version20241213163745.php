<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241213163745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cannabis_producer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cannabis_product ADD producer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cannabis_product ADD CONSTRAINT FK_291705E189B658FE FOREIGN KEY (producer_id) REFERENCES cannabis_producer (id)');
        $this->addSql('CREATE INDEX IDX_291705E189B658FE ON cannabis_product (producer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cannabis_product DROP FOREIGN KEY FK_291705E189B658FE');
        $this->addSql('DROP TABLE cannabis_producer');
        $this->addSql('DROP INDEX IDX_291705E189B658FE ON cannabis_product');
        $this->addSql('ALTER TABLE cannabis_product DROP producer_id');
    }
}
