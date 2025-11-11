<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251111205707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous ADD liste_collectes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A3CA200B5 FOREIGN KEY (liste_collectes_id) REFERENCES collecte (id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A3CA200B5 ON rendez_vous (liste_collectes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A3CA200B5');
        $this->addSql('DROP INDEX IDX_65E8AA0A3CA200B5 ON rendez_vous');
        $this->addSql('ALTER TABLE rendez_vous DROP liste_collectes_id');
    }
}
