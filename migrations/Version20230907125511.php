<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907125511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_intervention_type (intervention_id INT NOT NULL, intervention_type_id INT NOT NULL, INDEX IDX_C9B604D68EAE3863 (intervention_id), INDEX IDX_C9B604D68EA2F8F6 (intervention_type_id), PRIMARY KEY(intervention_id, intervention_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention_type_equipment_type (intervention_type_id INT NOT NULL, equipment_type_id INT NOT NULL, INDEX IDX_6B7F35CA8EA2F8F6 (intervention_type_id), INDEX IDX_6B7F35CAB337437C (equipment_type_id), PRIMARY KEY(intervention_type_id, equipment_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention_intervention_type ADD CONSTRAINT FK_C9B604D68EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention_type ADD CONSTRAINT FK_C9B604D68EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_equipment_type ADD CONSTRAINT FK_6B7F35CA8EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_equipment_type ADD CONSTRAINT FK_6B7F35CAB337437C FOREIGN KEY (equipment_type_id) REFERENCES equipment_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention CHANGE intervention_date intervention_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE answers answers JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE person DROP phone');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention_intervention_type DROP FOREIGN KEY FK_C9B604D68EAE3863');
        $this->addSql('ALTER TABLE intervention_intervention_type DROP FOREIGN KEY FK_C9B604D68EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_equipment_type DROP FOREIGN KEY FK_6B7F35CA8EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_equipment_type DROP FOREIGN KEY FK_6B7F35CAB337437C');
        $this->addSql('DROP TABLE intervention_intervention_type');
        $this->addSql('DROP TABLE intervention_type_equipment_type');
        $this->addSql('ALTER TABLE intervention CHANGE intervention_date intervention_date DATETIME NOT NULL, CHANGE answers answers LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE person ADD phone VARCHAR(255) NOT NULL');
    }
}
