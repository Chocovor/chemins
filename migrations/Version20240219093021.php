<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219093021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events ADD user_id INT NOT NULL, ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_5387574AA76ED395 ON events (user_id)');
        $this->addSql('CREATE INDEX IDX_5387574ABCF5E72D ON events (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AA76ED395');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574ABCF5E72D');
        $this->addSql('DROP INDEX IDX_5387574AA76ED395 ON events');
        $this->addSql('DROP INDEX IDX_5387574ABCF5E72D ON events');
        $this->addSql('ALTER TABLE events DROP user_id, DROP categorie_id');
    }
}
