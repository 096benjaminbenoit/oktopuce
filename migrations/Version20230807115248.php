<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807115248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sav_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7440455217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nfc_id INT DEFAULT NULL, location_id INT DEFAULT NULL, gas_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, installation_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', serial_number VARCHAR(255) NOT NULL, location_detail VARCHAR(255) NOT NULL, product_type VARCHAR(255) NOT NULL, placement_type VARCHAR(255) NOT NULL, remote_number VARCHAR(255) NOT NULL, gas_weight DOUBLE PRECISION NOT NULL, leak_detection TINYINT(1) NOT NULL, next_leak_control DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', finality JSON NOT NULL, capacity DOUBLE PRECISION NOT NULL, picto VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B8B4C6F325DD09AB (nfc_id), INDEX IDX_B8B4C6F364D218E (location_id), INDEX IDX_B8B4C6F3E0EBD3EC (gas_id), INDEX IDX_B8B4C6F344F5D008 (brand_id), INDEX IDX_B8B4C6F3727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gas_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, eq_co2_per_kg DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, equipement_id INT DEFAULT NULL, person_id INT DEFAULT NULL, technicien VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, intervention_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D11814AB806F0F5C (equipement_id), INDEX IDX_D11814AB217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nfc_tag (id INT AUTO_INCREMENT NOT NULL, uid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_694309E419EB6921 (client_id), INDEX IDX_694309E4E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, phone VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9444F97DD (phone), UNIQUE INDEX UNIQ_1483A5E9217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F325DD09AB FOREIGN KEY (nfc_id) REFERENCES nfc_tag (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F364D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3E0EBD3EC FOREIGN KEY (gas_id) REFERENCES gas_types (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F344F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3727ACA70 FOREIGN KEY (parent_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E4E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455217BBB47');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F325DD09AB');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F364D218E');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3E0EBD3EC');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F344F5D008');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3727ACA70');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB806F0F5C');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB217BBB47');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E419EB6921');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E4E7A1254A');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9217BBB47');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE gas_types');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE nfc_tag');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
