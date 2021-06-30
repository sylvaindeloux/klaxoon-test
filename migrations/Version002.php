<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add name to tags table.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE tags ADD name VARCHAR(255) NOT NULL AFTER id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE tags DROP name');
    }
}
