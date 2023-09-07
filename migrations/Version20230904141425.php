<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230904141425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention_intervention_type DROP FOREIGN KEY FK_C9B604D68EAE3863');
        $this->addSql('ALTER TABLE intervention_intervention_type DROP FOREIGN KEY FK_C9B604D68EA2F8F6');
        $this->addSql('DROP TABLE intervention_intervention_type');
        $this->addSql('ALTER TABLE intervention ADD intervention_type_id INT NOT NULL, RENAME COLUMN response TO answers');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB8EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id)');
        $this->addSql('CREATE INDEX IDX_D11814AB8EA2F8F6 ON intervention (intervention_type_id)');
        $this->addSql('ALTER TABLE intervention_question CHANGE intervention_type_id intervention_type_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_intervention_type (intervention_id INT NOT NULL, intervention_type_id INT NOT NULL, INDEX IDX_C9B604D68EA2F8F6 (intervention_type_id), INDEX IDX_C9B604D68EAE3863 (intervention_id), PRIMARY KEY(intervention_id, intervention_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE intervention_intervention_type ADD CONSTRAINT FK_C9B604D68EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention_type ADD CONSTRAINT FK_C9B604D68EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB8EA2F8F6');
        $this->addSql('DROP INDEX IDX_D11814AB8EA2F8F6 ON intervention');
        $this->addSql('ALTER TABLE intervention DROP intervention_type_id, RENAME COLUMN answers TO response');
        $this->addSql('ALTER TABLE intervention_question CHANGE intervention_type_id intervention_type_id INT NOT NULL');
    }
}
