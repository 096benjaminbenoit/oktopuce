<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828101544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_type_equipment_type (intervention_type_id INT NOT NULL, equipment_type_id INT NOT NULL, INDEX IDX_6B7F35CA8EA2F8F6 (intervention_type_id), INDEX IDX_6B7F35CAB337437C (equipment_type_id), PRIMARY KEY(intervention_type_id, equipment_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention_type_equipment_type ADD CONSTRAINT FK_6B7F35CA8EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_equipment_type ADD CONSTRAINT FK_6B7F35CAB337437C FOREIGN KEY (equipment_type_id) REFERENCES equipment_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention_question DROP FOREIGN KEY FK_9BBD1BB68EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_intervention_question DROP FOREIGN KEY FK_9BBD1BB660D47778');
        $this->addSql('DROP TABLE intervention_type_intervention_question');
        $this->addSql('ALTER TABLE intervention_question ADD intervention_type_id INT NOT NULL, ADD question_type VARCHAR(255) NOT NULL, ADD choices JSON DEFAULT NULL, ADD required TINYINT(1) NOT NULL, CHANGE question question VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE intervention_question ADD CONSTRAINT FK_8B6432ED8EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id)');
        $this->addSql('CREATE INDEX IDX_8B6432ED8EA2F8F6 ON intervention_question (intervention_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_type_intervention_question (intervention_type_id INT NOT NULL, intervention_question_id INT NOT NULL, INDEX IDX_9BBD1BB660D47778 (intervention_question_id), INDEX IDX_9BBD1BB68EA2F8F6 (intervention_type_id), PRIMARY KEY(intervention_type_id, intervention_question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE intervention_type_intervention_question ADD CONSTRAINT FK_9BBD1BB68EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention_question ADD CONSTRAINT FK_9BBD1BB660D47778 FOREIGN KEY (intervention_question_id) REFERENCES intervention_question (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_equipment_type DROP FOREIGN KEY FK_6B7F35CA8EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_equipment_type DROP FOREIGN KEY FK_6B7F35CAB337437C');
        $this->addSql('DROP TABLE intervention_type_equipment_type');
        $this->addSql('ALTER TABLE intervention_question DROP FOREIGN KEY FK_8B6432ED8EA2F8F6');
        $this->addSql('DROP INDEX IDX_8B6432ED8EA2F8F6 ON intervention_question');
        $this->addSql('ALTER TABLE intervention_question DROP intervention_type_id, DROP question_type, DROP choices, DROP required, CHANGE question question JSON NOT NULL');
    }
}
