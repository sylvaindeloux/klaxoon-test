<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added bookmarks & tags tables + relation table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bookmarks (id VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', height INT NOT NULL, width INT NOT NULL, duration DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookmarks_tags (bookmark_id VARCHAR(255) NOT NULL, tag_id VARCHAR(255) NOT NULL, INDEX IDX_CD7027B792741D25 (bookmark_id), INDEX IDX_CD7027B7BAD26311 (tag_id), PRIMARY KEY(bookmark_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookmarks_tags ADD CONSTRAINT FK_CD7027B792741D25 FOREIGN KEY (bookmark_id) REFERENCES bookmarks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bookmarks_tags ADD CONSTRAINT FK_CD7027B7BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bookmarks_tags DROP FOREIGN KEY FK_CD7027B792741D25');
        $this->addSql('ALTER TABLE bookmarks_tags DROP FOREIGN KEY FK_CD7027B7BAD26311');
        $this->addSql('DROP TABLE bookmarks');
        $this->addSql('DROP TABLE bookmarks_tags');
        $this->addSql('DROP TABLE tags');
    }
}
