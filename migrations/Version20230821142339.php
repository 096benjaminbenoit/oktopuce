<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821142339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sav_number VARCHAR(255) DEFAULT NULL, sav_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7440455217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_site (contact_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_41BC8B1BE7A1254A (contact_id), INDEX IDX_41BC8B1BF6BD1646 (site_id), PRIMARY KEY(contact_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nfc_tag_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, location_id INT DEFAULT NULL, equipment_type_id INT DEFAULT NULL, placement_id INT DEFAULT NULL, gas_id INT DEFAULT NULL, installation_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', serial_number VARCHAR(255) NOT NULL, location_detail LONGTEXT DEFAULT NULL, remote_number VARCHAR(255) DEFAULT NULL, gas_weight DOUBLE PRECISION DEFAULT NULL, has_leak_detection TINYINT(1) DEFAULT NULL, last_leak_detection DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', next_leak_detection DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', capacity DOUBLE PRECISION DEFAULT NULL, picto VARCHAR(255) DEFAULT NULL, INDEX IDX_D338D583727ACA70 (parent_id), UNIQUE INDEX UNIQ_D338D5838334582F (nfc_tag_id), INDEX IDX_D338D58344F5D008 (brand_id), INDEX IDX_D338D58364D218E (location_id), INDEX IDX_D338D583B337437C (equipment_type_id), INDEX IDX_D338D5832F966E9D (placement_id), INDEX IDX_D338D583E0EBD3EC (gas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment_finality (equipment_id INT NOT NULL, finality_id INT NOT NULL, INDEX IDX_9F9B06EC517FE9FE (equipment_id), INDEX IDX_9F9B06EC967CF506 (finality_id), PRIMARY KEY(equipment_id, finality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finality (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gas_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, eq_co2_per_kg DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, equipment_id INT DEFAULT NULL, technician VARCHAR(255) DEFAULT NULL, enterprise VARCHAR(255) DEFAULT NULL, response JSON NOT NULL, intervention_date DATETIME NOT NULL, INDEX IDX_D11814AB217BBB47 (person_id), INDEX IDX_D11814AB517FE9FE (equipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_intervention (intervention_source INT NOT NULL, intervention_target INT NOT NULL, INDEX IDX_D466B039B52A5D56 (intervention_source), INDEX IDX_D466B039ACCF0DD9 (intervention_target), PRIMARY KEY(intervention_source, intervention_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_type_intervention_question (intervention_type_id INT NOT NULL, intervention_question_id INT NOT NULL, INDEX IDX_9BBD1BB68EA2F8F6 (intervention_type_id), INDEX IDX_9BBD1BB660D47778 (intervention_question_id), PRIMARY KEY(intervention_type_id, intervention_question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_type_intervention (intervention_type_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_1C8CE5938EA2F8F6 (intervention_type_id), INDEX IDX_1C8CE5938EAE3863 (intervention_id), PRIMARY KEY(intervention_type_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, manuel_link VARCHAR(255) DEFAULT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nfc_tag (id INT AUTO_INCREMENT NOT NULL, uid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE placement (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_694309E419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, phone VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649444F97DD (phone), UNIQUE INDEX UNIQ_8D93D649217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE contact_site ADD CONSTRAINT FK_41BC8B1BE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_site ADD CONSTRAINT FK_41BC8B1BF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583727ACA70 FOREIGN KEY (parent_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5838334582F FOREIGN KEY (nfc_tag_id) REFERENCES nfc_tag (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58344F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58364D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583B337437C FOREIGN KEY (equipment_type_id) REFERENCES equipment_type (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5832F966E9D FOREIGN KEY (placement_id) REFERENCES placement (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583E0EBD3EC FOREIGN KEY (gas_id) REFERENCES gas_type (id)');
        $this->addSql('ALTER TABLE equipment_finality ADD CONSTRAINT FK_9F9B06EC517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_finality ADD CONSTRAINT FK_9F9B06EC967CF506 FOREIGN KEY (finality_id) REFERENCES finality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE intervention_intervention ADD CONSTRAINT FK_D466B039B52A5D56 FOREIGN KEY (intervention_source) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention ADD CONSTRAINT FK_D466B039ACCF0DD9 FOREIGN KEY (intervention_target) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention_question ADD CONSTRAINT FK_9BBD1BB68EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention_question ADD CONSTRAINT FK_9BBD1BB660D47778 FOREIGN KEY (intervention_question_id) REFERENCES intervention_question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention ADD CONSTRAINT FK_1C8CE5938EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention ADD CONSTRAINT FK_1C8CE5938EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455217BBB47');
        $this->addSql('ALTER TABLE contact_site DROP FOREIGN KEY FK_41BC8B1BE7A1254A');
        $this->addSql('ALTER TABLE contact_site DROP FOREIGN KEY FK_41BC8B1BF6BD1646');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583727ACA70');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D5838334582F');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D58344F5D008');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D58364D218E');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583B337437C');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D5832F966E9D');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583E0EBD3EC');
        $this->addSql('ALTER TABLE equipment_finality DROP FOREIGN KEY FK_9F9B06EC517FE9FE');
        $this->addSql('ALTER TABLE equipment_finality DROP FOREIGN KEY FK_9F9B06EC967CF506');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB217BBB47');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB517FE9FE');
        $this->addSql('ALTER TABLE intervention_intervention DROP FOREIGN KEY FK_D466B039B52A5D56');
        $this->addSql('ALTER TABLE intervention_intervention DROP FOREIGN KEY FK_D466B039ACCF0DD9');
        $this->addSql('ALTER TABLE intervention_type_intervention_question DROP FOREIGN KEY FK_9BBD1BB68EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_intervention_question DROP FOREIGN KEY FK_9BBD1BB660D47778');
        $this->addSql('ALTER TABLE intervention_type_intervention DROP FOREIGN KEY FK_1C8CE5938EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_intervention DROP FOREIGN KEY FK_1C8CE5938EAE3863');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E419EB6921');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649217BBB47');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_site');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE equipment_finality');
        $this->addSql('DROP TABLE equipment_type');
        $this->addSql('DROP TABLE finality');
        $this->addSql('DROP TABLE gas_type');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE intervention_intervention');
        $this->addSql('DROP TABLE intervention_question');
        $this->addSql('DROP TABLE intervention_type');
        $this->addSql('DROP TABLE intervention_type_intervention_question');
        $this->addSql('DROP TABLE intervention_type_intervention');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE nfc_tag');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE placement');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
